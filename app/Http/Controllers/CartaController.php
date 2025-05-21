<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Services\GoogleDriveService;
use Illuminate\Support\Facades\Auth;

class CartaController extends Controller
{
    protected $driveService;

    /**
     * Constructor to inject the Google Drive service dependency.
     *
     * @param GoogleDriveService $driveService
     */
    public function __construct(GoogleDriveService $driveService)
    {
        $this->driveService = $driveService;
    }

    /**
     * Generates a PDF document with user and device assignment information,
     * saves it locally, uploads it to Google Drive, and returns it as a download response.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function generarPDF(Request $request)
    {
        try {
            // Retrieve data from the incoming request
            $userId = $request->input('user_id');
            $tipoAsignacion = $request->input('tipo_asignacion');
            $assignedDevices = $request->input('assigned_devices', []);

            \Log::info('📥 Datos recibidos en generarPDF:', [
                'user_id' => $userId,
                'tipo_asignacion' => $tipoAsignacion,
                'assigned_devices' => $assignedDevices
            ]);

            // Validate that at least one device is assigned
            if (empty($assignedDevices)) {
                throw new \Exception('❌ No se recibieron dispositivos asignados.');
            }

            // Retrieve user data from external controller/service
            $endUserController = new EndUserController();
            $response = $endUserController->getUserById(new Request(['user_id' => $userId]));
            $data = $response->getData(true);

            // Validate that user data was found
            if (empty($data['employees'])) {
                throw new \Exception('❌ Empleado no encontrado.');
            }

            $employee = $data['employees'][0];

            // Prepare data to be injected into the PDF view
            $pdfData = [
                'nombreUsuario'    => $employee['display_name'],
                'userId'           => $employee['user_id'],
                'email'            => $employee['email'],
                'position'         => $employee['position'],
                'location'         => $employee['location'],
                'costCenter'       => $employee['cost_center_name'],
                'supervisor'       => $employee['supervisor'],
                'fechaAceptacion'  => Carbon::now()->format('d/m/Y H:i:s'),
                'tipo_asignacion'  => $tipoAsignacion,
                'assigned_devices' => $assignedDevices
            ];

            \Log::info('✅ Datos enviados a la vista para el PDF:', $pdfData);

            // Generate the PDF using the Blade view
            $pdf = Pdf::loadView('carta_asignacion', $pdfData);

            // Save the PDF locally
            $fileName = "Carta_Asignacion_{$userId}.pdf";
            $filePath = storage_path("app/public/{$fileName}");
            $pdf->save($filePath);

            // Upload the PDF to Google Drive
            $this->driveService->uploadFile($filePath, $fileName);

            // Return the PDF file as a streamed download
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, $fileName, [
                'Content-Type' => 'application/pdf',
            ]);
        } catch (\Exception $e) {
            // Log and return any exception that occurs
            \Log::error('❌ Error en generarPDF:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Displays the letter view for the given user, validating authentication
     * and matching email identity. It also decodes the assigned devices
     * from the query string if provided.
     *
     * @param Request $request
     * @param string $user_id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function mostrarCarta(Request $request, $user_id)
    {
        try {
            $tipoAsignacion = $request->input('tipo_asignacion', 'Asignación Regular');

            // Try to decode the assigned devices from base64 in the query string
            $encodedDevices = $request->query('devices');
            $assignedDevices = [];

            if ($encodedDevices) {
                $json = base64_decode($encodedDevices);
                $decoded = json_decode($json, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    $assignedDevices = $decoded;
                } else {
                    \Log::warning('❗ Error al decodificar dispositivos: JSON inválido');
                }
            }

            \Log::info('📥 Datos recibidos en mostrarCarta:', [
                'user_id' => $user_id,
                'tipo_asignacion' => $tipoAsignacion,
                'assigned_devices' => $assignedDevices
            ]);

            // Redirect to Google login if not authenticated
            if (!Auth::check()) {
                session(['redirect_after_login' => url()->full()]);
                return redirect()->route('google.redirect');
            }

            $user = Auth::user();

            // Retrieve employee data using internal service
            $endUserController = new EndUserController();
            $response = $endUserController->getUserById(new Request(['user_id' => $user_id]));
            $data = $response->getData(true);

            if (empty($data['employees'])) {
                throw new \Exception('Empleado no encontrado.');
            }

            $employee = $data['employees'][0];

            // Ensure the logged-in user matches the employee data
            if ($user->email !== $employee['email']) {
                abort(403, 'No tienes permiso para firmar esta carta.');
            }

            // Return the Blade view with decoded data
            return view('letter', [
                'nombreUsuario'    => $employee['display_name'],
                'userId'           => $employee['user_id'],
                'email'            => $employee['email'],
                'position'         => $employee['position'],
                'location'         => $employee['location'],
                'costCenter'       => $employee['cost_center_name'],
                'supervisor'       => $employee['supervisor'],
                'fechaAceptacion'  => Carbon::now()->format('d/m/Y H:i:s'),
                'tipo_asignacion'  => $tipoAsignacion,
                'assigned_devices' => $assignedDevices // ✅ Now properly decoded
            ]);

        } catch (\Exception $e) {
            \Log::error('❌ Error al mostrar la carta:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

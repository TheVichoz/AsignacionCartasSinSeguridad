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

    public function __construct(GoogleDriveService $driveService)
    {
        $this->driveService = $driveService;
    }

    public function generarPDF(Request $request)
    {
        try {
            $userId = $request->input('user_id');
            $tipoAsignacion = $request->input('tipo_asignacion');
            $assignedDevices = $request->input('assigned_devices', []);

            \Log::info('📥 Datos recibidos en generarPDF:', [
                'user_id' => $userId,
                'tipo_asignacion' => $tipoAsignacion,
                'assigned_devices' => $assignedDevices
            ]);

            if (empty($assignedDevices)) {
                throw new \Exception('❌ No se recibieron dispositivos asignados.');
            }

            $endUserController = new EndUserController();
            $response = $endUserController->getUserById(new Request(['user_id' => $userId]));
            $data = $response->getData(true);

            if (empty($data['employees'])) {
                throw new \Exception('❌ Empleado no encontrado.');
            }

            $employee = $data['employees'][0];

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

            $pdf = Pdf::loadView('carta_asignacion', $pdfData);

            $fileName = "Carta_Asignacion_{$userId}.pdf";
            $filePath = storage_path("app/public/{$fileName}");
            $pdf->save($filePath);

            // $this->driveService->uploadFile($filePath, $fileName); // ← Desactivado por solicitud

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, $fileName, [
                'Content-Type' => 'application/pdf',
            ]);
        } catch (\Exception $e) {
            \Log::error('❌ Error en generarPDF:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function mostrarCarta(Request $request, $user_id)
    {
        try {
            $tipoAsignacion = $request->input('tipo_asignacion', 'Asignación Regular');

            // ✅ Soporta ambos nombres: ?devices= o ?dispositivos=
            $encodedDevices = $request->query('devices') ?? $request->query('dispositivos');
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

            $endUserController = new EndUserController();
            $response = $endUserController->getUserById(new Request(['user_id' => $user_id]));
            $data = $response->getData(true);

            if (empty($data['employees'])) {
                throw new \Exception('Empleado no encontrado.');
            }

            $employee = $data['employees'][0];

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
                'assigned_devices' => $assignedDevices
            ]);

        } catch (\Exception $e) {
            \Log::error('❌ Error al mostrar la carta:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

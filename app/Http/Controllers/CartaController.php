<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Services\GoogleDriveService;
use App\Services\BrevoMailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\EndUser; // ✅ Agregado para usar directamente el modelo

class CartaController extends Controller
{
    protected $driveService;
    protected $brevo;

    public function __construct(GoogleDriveService $driveService, BrevoMailer $brevo)
    {
        $this->driveService = $driveService;
        $this->brevo = $brevo;
    }

    public function enviarCartaParaAprobacion(Request $request)
    {
        try {
            $userId = $request->input('user_id');
            $tipoAsignacion = $request->input('tipo_asignacion');
            $assignedDevices = $request->input('assigned_devices', []);

            if (empty($assignedDevices)) {
                return response()->json(['error' => 'No se recibieron dispositivos.'], 422);
            }

            $devicesEncoded = base64_encode(json_encode($assignedDevices));
            $url = url("/asset/autorizar/{$userId}?devices={$devicesEncoded}&tipo_asignacion={$tipoAsignacion}");

            $this->brevo->enviarCorreoConLink(
                'pololohdz2000@gmail.com',
                'Responsable de Revisión',
                $url,
                $tipoAsignacion
            );

            return response()->json(['success' => '✅ Carta enviada al Asset para aprobación']);
        } catch (\Exception $e) {
            Log::error('❌ Error en enviarCartaParaAprobacion:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function generarPDF(Request $request)
    {
        try {
            $userId = $request->input('user_id');
            $tipoAsignacion = $request->input('tipo_asignacion');
            $assignedDevices = $request->input('assigned_devices', []);

            Log::info('📥 Datos recibidos en generarPDF:', compact('userId', 'tipoAsignacion', 'assignedDevices'));

            if (empty($assignedDevices)) {
                throw new \Exception('❌ No se recibieron dispositivos asignados.');
            }

            $employee = EndUser::where('user_id', trim($userId))->first();
            if (!$employee) {
                throw new \Exception('❌ Empleado no encontrado.');
            }

            $pdfData = [
                'nombreUsuario'    => $employee->display_name,
                'userId'           => $employee->user_id,
                'email'            => $employee->email,
                'position'         => $employee->position,
                'location'         => $employee->location,
                'costCenter'       => $employee->cost_center_name,
                'supervisor'       => $employee->supervisor,
                'fechaAceptacion'  => Carbon::now()->format('d/m/Y H:i:s'),
                'tipo_asignacion'  => $tipoAsignacion,
                'assigned_devices' => $assignedDevices
            ];

            $pdf = Pdf::loadView('carta_asignacion', $pdfData);
            $fileName = "Carta_Asignacion_{$userId}.pdf";
            $filePath = storage_path("app/public/{$fileName}");
            $pdf->save($filePath);

            return response()->json(['message' => 'Carta generada, guardada y enviada por correo al Asset.'], 200);
        } catch (\Exception $e) {
            Log::error('❌ Error en generarPDF:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function mostrarCarta(Request $request, $user_id)
    {
        try {
            $tipoAsignacion = $request->input('tipo_asignacion', 'Asignación Regular');
            $encodedDevices = $request->query('devices') ?? $request->query('dispositivos');
            $assignedDevices = [];

            if ($encodedDevices) {
                $json = base64_decode($encodedDevices);
                $decoded = json_decode($json, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $assignedDevices = $decoded;
                }
            }

            $employee = EndUser::where('user_id', trim($user_id))->first();
            if (!$employee) {
                throw new \Exception('Empleado no encontrado.');
            }

            return view('letter', [
                'nombreUsuario'    => $employee->display_name,
                'userId'           => $employee->user_id,
                'email'            => $employee->email,
                'position'         => $employee->position,
                'location'         => $employee->location,
                'costCenter'       => $employee->cost_center_name,
                'supervisor'       => $employee->supervisor,
                'fechaAceptacion'  => now()->format('d/m/Y H:i:s'),
                'tipo_asignacion'  => $tipoAsignacion,
                'assigned_devices' => $assignedDevices
            ]);
        } catch (\Exception $e) {
            Log::error('❌ Error al mostrar la carta:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function vistaParaAsset($user_id, Request $request)
    {
        try {
            $user_id = trim($user_id);
            Log::info('🔍 vistaParaAsset - user_id recibido:', [$user_id]);

            $tipoAsignacion = $request->input('tipo_asignacion', 'Asignación Regular');
            $encodedDevices = $request->query('devices') ?? $request->query('dispositivos');
            $assignedDevices = [];

            if ($encodedDevices) {
                $json = base64_decode($encodedDevices);
                $decoded = json_decode($json, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $assignedDevices = $decoded;
                }
            }

            $employee = EndUser::where('user_id', $user_id)->first();
            if (!$employee) {
                throw new \Exception('Empleado no encontrado.');
            }

            return view('asset', [
                'nombreUsuario'    => $employee->display_name,
                'userId'           => $employee->user_id,
                'email'            => $employee->email,
                'position'         => $employee->position,
                'location'         => $employee->location,
                'costCenter'       => $employee->cost_center_name,
                'supervisor'       => $employee->supervisor,
                'fechaAceptacion'  => now()->format('d/m/Y H:i:s'),
                'tipo_asignacion'  => $tipoAsignacion,
                'assigned_devices' => $assignedDevices
            ]);
        } catch (\Exception $e) {
            Log::error('❌ Error en vistaParaAsset:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function aprobarDesdeAsset(Request $request)
    {
        try {
            $userId = $request->input('user_id');
            $tipoAsignacion = $request->input('tipo_asignacion');
            $assignedDevices = $request->input('assigned_devices', []);

            if (empty($assignedDevices)) {
                return response()->json(['error' => 'No se recibieron dispositivos.'], 422);
            }

            Log::info('🛡️ Asset aprobó carta, se genera PDF y se notificará al usuario', compact('userId', 'tipoAsignacion', 'assignedDevices'));

            $employee = EndUser::where('user_id', trim($userId))->first();
            if (!$employee) {
                throw new \Exception('Empleado no encontrado.');
            }

            $devicesEncoded = base64_encode(json_encode($assignedDevices));
            $linkFirma = url("/letter/{$userId}?devices={$devicesEncoded}&tipo_asignacion={$tipoAsignacion}");

            $this->brevo->enviarCorreoConLink(
                $employee->email,
                $employee->display_name,
                $linkFirma,
                $tipoAsignacion
            );

            return response()->json(['message' => 'Carta aprobada por el Asset. Enlace enviado al usuario. ✅']);
        } catch (\Exception $e) {
            Log::error('❌ Error al aprobar desde Asset:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function firmarCarta(Request $request)
    {
        try {
            $userId = $request->input('user_id');
            $tipoAsignacion = $request->input('tipo_asignacion');
            $assignedDevices = $request->input('assigned_devices', []);

            if (empty($assignedDevices)) {
                return response()->json(['error' => 'No se recibieron dispositivos.'], 422);
            }

            $employee = EndUser::where('user_id', trim($userId))->first();
            if (!$employee) {
                return response()->json(['error' => 'Empleado no encontrado.'], 404);
            }

            $pdfData = [
                'nombreUsuario'    => $employee->display_name,
                'userId'           => $employee->user_id,
                'email'            => $employee->email,
                'position'         => $employee->position,
                'location'         => $employee->location,
                'costCenter'       => $employee->cost_center_name,
                'supervisor'       => $employee->supervisor,
                'fechaAceptacion'  => now()->format('d/m/Y H:i:s'),
                'tipo_asignacion'  => $tipoAsignacion,
                'assigned_devices' => $assignedDevices
            ];

            $pdf = Pdf::loadView('carta_asignacion', $pdfData);
            $fileName = "Carta_Firmada_{$userId}.pdf";
            $filePath = storage_path("app/public/{$fileName}");
            $pdf->save($filePath);

            Mail::raw('Tu carta de asignación ha sido firmada exitosamente. Se adjunta el documento.', function ($message) use ($employee, $filePath) {
                $message->to($employee->email)
                        ->subject('📄 Carta Firmada')
                        ->attach($filePath);
            });

            return response()->json(['message' => 'Carta firmada y enviada al usuario. ✅']);
        } catch (\Exception $e) {
            Log::error('❌ Error en firmarCarta:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

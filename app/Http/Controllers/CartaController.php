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
        $retiredDevices = $request->input('retired_devices', []);

        if (empty($assignedDevices)) {
            return response()->json(['error' => 'No se recibieron dispositivos.'], 422);
        }

        // 🟢 Generar el folio aquí
        $folio = $this->generarFolio();

        // Codificar dispositivos
        $devicesEncoded = base64_encode(json_encode($assignedDevices));
        $retiredEncoded = base64_encode(json_encode($retiredDevices));

        // 🟢 Incluir el folio en la URL
        $url = url("/asset/autorizar/{$userId}?folio={$folio}&devices={$devicesEncoded}&retirados={$retiredEncoded}&tipo_asignacion={$tipoAsignacion}");

        // Enviar correo
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
            $retiredDevices = $request->input('retired_devices', []);


            Log::info('📥 Datos recibidos en generarPDF:', compact('userId', 'tipoAsignacion', 'assignedDevices'));

            if (empty($assignedDevices)) {
                throw new \Exception('❌ No se recibieron dispositivos asignados.');
            }

            $employee = EndUser::where('user_id', trim($userId))->first();
            if (!$employee) {
                throw new \Exception('❌ Empleado no encontrado.');
            }
            // Leer imágenes en base64
$logoWhirlpool = base64_encode(file_get_contents(public_path('img/whirlpoollogo2.jpg')));
$logoGtim = base64_encode(file_get_contents(public_path('img/gtimlogo.jpg')));

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
                'assigned_devices' => $assignedDevices,
                'retired_devices' => $retiredDevices,
                'logoWhirlpool' => $logoWhirlpool,
'logoGtim' => $logoGtim
            ];

            $pdf = Pdf::loadView('carta_asignacion', $pdfData)
          ->setPaper('letter', 'portrait');
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
        $folio = $request->query('folio', 'SIN-FOLIO');

        // Decodificar dispositivos
        $encodedDevices = $request->query('devices') ?? $request->query('dispositivos');
        $assignedDevices = [];
        if ($encodedDevices) {
            $json = base64_decode($encodedDevices);
            $decoded = json_decode($json, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $assignedDevices = $decoded;
            }
        }

        $retiredDevices = [];
        $encodedRetirados = $request->query('retirados');
        if ($encodedRetirados) {
            $json = base64_decode($encodedRetirados);
            $decoded = json_decode($json, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $retiredDevices = $decoded;
            }
        }

        $employee = EndUser::where('user_id', trim($user_id))->first();
        if (!$employee) {
            throw new \Exception('Empleado no encontrado.');
        }

        $logoWhirlpool = base64_encode(file_get_contents(public_path('img/whirlpoollogo2.jpg')));
        $logoGtim = base64_encode(file_get_contents(public_path('img/gtimlogo.jpg')));

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
            'assigned_devices' => $assignedDevices,
            'retired_devices'  => $retiredDevices,
            'logoWhirlpool'    => $logoWhirlpool,
            'logoGtim'         => $logoGtim,
            'folio'            => $folio
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
        $folio = $request->query('folio', 'WH0000000'); // 🟢 Leer el folio de la URL

        // Dispositivos asignados
        $encodedDevices = $request->query('devices') ?? $request->query('dispositivos');
        $assignedDevices = [];
        if ($encodedDevices) {
            $json = base64_decode($encodedDevices);
            $decoded = json_decode($json, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $assignedDevices = $decoded;
            }
        }

        // Dispositivos retirados
        $retiredDevices = [];
        $encodedRetirados = $request->query('retirados');
        if ($encodedRetirados) {
            $json = base64_decode($encodedRetirados);
            $decoded = json_decode($json, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $retiredDevices = $decoded;
            }
        }

        // Buscar empleado
        $employee = EndUser::where('user_id', $user_id)->first();
        if (!$employee) {
            throw new \Exception('Empleado no encontrado.');
        }

        // Logos
        $logoWhirlpool = base64_encode(file_get_contents(public_path('img/whirlpoollogo2.jpg')));
        $logoGtim = base64_encode(file_get_contents(public_path('img/gtimlogo.jpg')));

        // Renderizar vista
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
            'assigned_devices' => $assignedDevices,
            'retired_devices'  => $retiredDevices,
            'logoWhirlpool'    => $logoWhirlpool,
            'logoGtim'         => $logoGtim,
            'folio'            => $folio
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
        $folio = $request->json('folio', 'SIN-FOLIO');


        $assignedDevices = $request->input('assigned_devices', []);
        $retiredDevices = $request->input('retired_devices', []);

        if (empty($assignedDevices)) {
            return response()->json(['error' => 'No se recibieron dispositivos.'], 422);
        }

        Log::info('🛡️ Asset aprobó carta. Se notifica al usuario.', compact('userId', 'tipoAsignacion', 'assignedDevices', 'folio'));

        $employee = EndUser::where('user_id', trim($userId))->first();
        if (!$employee) {
            throw new \Exception('Empleado no encontrado.');
        }

        $devicesEncoded = base64_encode(json_encode($assignedDevices));
        $retiredEncoded = base64_encode(json_encode($retiredDevices));

        // OJO: folio está en el enlace
        $linkFirma = url("/letter/{$userId}?devices={$devicesEncoded}&retirados={$retiredEncoded}&tipo_asignacion={$tipoAsignacion}&folio={$folio}");

        $this->brevo->enviarCorreoParaEmpleado(
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
        $retiredDevices = $request->input('retired_devices', []);
        $folio = $request->input('folio', 'SIN-FOLIO'); // ✅ aquí

        if (empty($assignedDevices)) {
            return response()->json(['error' => 'No se recibieron dispositivos.'], 422);
        }

        $employee = EndUser::where('user_id', trim($userId))->first();
        if (!$employee) {
            return response()->json(['error' => 'Empleado no encontrado.'], 404);
        }

        $logoWhirlpool = base64_encode(file_get_contents(public_path('img/whirlpoollogo2.jpg')));
        $logoGtim = base64_encode(file_get_contents(public_path('img/gtimlogo.jpg')));

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
            'assigned_devices' => $assignedDevices,
            'retired_devices'  => $retiredDevices,
            'logoWhirlpool'    => $logoWhirlpool,
            'logoGtim'         => $logoGtim,
            'folio'            => $folio // ✅ aquí
        ];

        $pdf = \Pdf::loadView('carta_asignacion', $pdfData)
            ->setPaper('letter', 'portrait');
        $fileName = "Carta_Firmada_{$userId}.pdf";
        $filePath = storage_path("app/public/{$fileName}");
        $pdf->save($filePath);

        $body = "
            <p>Hola {$employee->display_name},</p>
            <p>Tu carta de asignación ha sido firmada exitosamente. Se adjunta el documento PDF.</p>
        ";

        $this->brevo->enviarCorreoConAdjunto(
            $employee->email,
            $employee->display_name,
            '📄 Carta Firmada',
            $body,
            $filePath
        );

        return response()->json(['message' => 'Carta firmada y enviada al usuario. ✅']);
    } catch (\Exception $e) {
        \Log::error('❌ Error en firmarCarta:', ['error' => $e->getMessage()]);
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


private function generarFolio()
{
    $folio = \DB::table('folios')->lockForUpdate()->first();

    $nuevoNumero = $folio->ultimo_numero + 1;

    \DB::table('folios')->update(['ultimo_numero' => $nuevoNumero]);

    return 'WH' . str_pad($nuevoNumero, 7, '0', STR_PAD_LEFT);
}

}

<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EndUserController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\CorreoController;
use App\Http\Controllers\CartaController;

// IMPORTACIÓN DIRECTA DEL MIDDLEWARE DE SPATIE
use Spatie\Permission\Middleware\RoleMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 👇 Redirige directamente a la vista dss.blade.php
Route::get('/', function () {
    return view('dss.dss');
});

// 🔒 AUTENTICACIÓN DESHABILITADA PARA PRUEBAS
/*
Route::get('/auth/redirect/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.redirect');

Route::get('/auth/callback/google', function () {
    try {
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt('default_password'),
            ]
        );

        Auth::login($user);
        return redirect('/dashboard');

    } catch (\Exception $e) {
        \Log::error('❌ Error en Google Callback:', ['error' => $e->getMessage()]);
        return redirect('/')->with('error', 'Error autenticando con Google.');
    }
});
*/

// 🔒 Rutas protegidas también deshabilitadas
/*
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.admi');
        } elseif ($user->hasRole('employee')) {
            return view('employee.dashboard', compact('user'));
        } elseif ($user->hasRole('dss')) {
            return redirect()->route('dss.dashboard');
        }

        abort(403, 'Access denied.');
    });
});

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.admi');
});

Route::middleware(['auth', RoleMiddleware::class . ':dss'])->group(function () {
    Route::get('/dss', function () {
        return view('dss.dss');
    })->name('dss.dashboard');
});

Route::get('/logout', function (Request $request) {
    Auth::logout();
    session()->flush();
    return redirect('/')->with('googleLogout', 'https://accounts.google.com/logout');
})->name('logout');
*/

// ✅ Rutas públicas de consulta
Route::get('/api/getUser', [EndUserController::class, 'getUserById']);
Route::get('/getUserById', [EndUserController::class, 'getUserById']);
Route::get('/getDeviceList', [DeviceController::class, 'getDeviceList']);
Route::get('/getTechnicianList', [TechnicianController::class, 'getTechnicianList']);

// ✅ Envío de correo sin autenticación
Route::post('/enviar-correo', [CorreoController::class, 'enviarCorreo'])->name('enviar.correo');

// ✅ Flujo de carta sin seguridad
Route::get('/letter/{user_id}', [CartaController::class, 'mostrarCarta'])->name('letter.view');
Route::post('/letter-confirmar', [CartaController::class, 'generarPDF'])->name('letter.confirmar');
Route::get('/asset/autorizar/{user_id}', [CartaController::class, 'vistaParaAsset'])->name('asset.vista');
Route::post('/asset/aprobar', [CartaController::class, 'aprobarDesdeAsset'])->name('asset.aprobar');
Route::post('/letter/firmar', [CartaController::class, 'firmarCarta']);
Route::post('/letter-confirmar', [CartaController::class, 'firmarCarta'])->name('letter.confirmar');
Route::post('/enviar-a-asset', [CartaController::class, 'enviarCartaParaAprobacion'])->name('enviar.asset');

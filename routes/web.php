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

Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : view('welcome');
});

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

// ✅ USO DIRECTO DEL MIDDLEWARE SPATIE SIN ALIAS
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

Route::get('/api/getUser', [EndUserController::class, 'getUserById']);
Route::get('/getUserById', [EndUserController::class, 'getUserById']);
Route::get('/getDeviceList', [DeviceController::class, 'getDeviceList']);
Route::get('/getTechnicianList', [TechnicianController::class, 'getTechnicianList']);

Route::post('/enviar-correo', [CorreoController::class, 'enviarCorreo'])->name('enviar.correo');

Route::get('/letter/{user_id}', [CartaController::class, 'mostrarCarta'])->name('letter.view');
Route::post('/letter-confirmar', [CartaController::class, 'generarPDF'])->name('letter.confirmar');

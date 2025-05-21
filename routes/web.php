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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file defines all the web routes for the application. It includes:
| - Google OAuth login and callback
| - Role-based dashboard redirection
| - API endpoints for users/devices/technicians
| - Email sending and signature confirmation
|
*/

/**
 * Root route (welcome page)
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * 🔐 Redirect to Google OAuth login
 */
Route::get('/auth/redirect/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.redirect');

/**
 * ✅ Callback handler from Google OAuth
 * Retrieves the authenticated user and logs them in.
 */
Route::get('/auth/callback/google', function () {
    try {
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt('default_password'), // Password will not be used
            ]
        );

        Auth::login($user);

        // 🔁 Redirect back to the originally intended page
        return redirect(session('redirect_after_login', '/dashboard'));

    } catch (\Exception $e) {
        \Log::error('❌ Google callback error:', ['error' => $e->getMessage()]);
        return redirect('/')->with('error', 'Error authenticating with Google.');
    }
});

/**
 * 👤 Role-based dashboard (admin, employee, dss)
 */
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.admi');
        } elseif ($user->hasRole('employee')) {
            return view('employee.dashboard', compact('user'));
        } elseif ($user->hasRole('dss')) {
            return view('dss.dss');
        }

        abort(403, 'Access denied.');
    });
});

/**
 * 👮 Protected routes by role
 * Only accessible if the user is authenticated and has the correct role.
 */
Route::middleware(['auth', \Spatie\Permission\Middleware\RoleMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.admi');
    Route::get('/dss', function () {
        return view('dss.dss');
    })->name('dss.dashboard');
});

/**
 * 🚪 Logout
 * Logs out the user and flushes the session.
 */
Route::get('/logout', function (Request $request) {
    Auth::logout();
    session()->flush();

    return redirect('/')->with('googleLogout', 'https://accounts.google.com/logout');
})->name('logout');

/**
 * 📄 Internal APIs
 */
Route::get('/api/getUser', [EndUserController::class, 'getUserById']);
Route::get('/getUserById', [EndUserController::class, 'getUserById']);
Route::get('/getDeviceList', [DeviceController::class, 'getDeviceList']);
Route::get('/getTechnicianList', [TechnicianController::class, 'getTechnicianList']);

/**
 * 📧 Send assignment notification email
 */
Route::post('/enviar-correo', [CorreoController::class, 'enviarCorreo'])->name('enviar.correo');

/**
 * 📝 Carta signature and PDF generation
 * - View letter
 * - Confirm acceptance and generate PDF
 */
Route::get('/letter/{user_id}', [CartaController::class, 'mostrarCarta'])->name('letter.view');
Route::post('/letter-confirmar', [CartaController::class, 'generarPDF'])->name('letter.confirmar');

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Technician;
use App\Models\Device;

/**
 * Class AdminController
 *
 * Handles the admin panel and ensures required data is available.
 *
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    /**
     * Displays the administration panel with all required data.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = Auth::user();
    
        if (!$user->hasRole('admin')) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    
        return view('admin.admi', compact('user'));
    }
}

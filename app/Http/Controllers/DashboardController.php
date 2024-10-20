<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SuperAdmin\SuperAdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        // Check user roles and redirect to appropriate controller
        if ($user->role_id == 1) {
            return redirect()->action([SuperAdminController::class, 'index']);
        }

        return view('welcome', ['user' => $user]); // Default view
    }

    public function profile()
    {
        return view('dashboard.profile', ['user' => Auth::user()]);
    }

    public function settings()
    {
        return view('dashboard.settings', ['user' => Auth::user()]);
    }
}
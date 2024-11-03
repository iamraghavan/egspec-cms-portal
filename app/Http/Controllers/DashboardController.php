<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SuperAdmin\SuperAdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use App\Models\User;
use App\Http\Controllers\Controller;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;

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
}

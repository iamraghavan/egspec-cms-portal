<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use App\Actions\Fortify\ResetUserPassword;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        // If you need to bind any services, do it here
    }

    public function boot()
    {

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email . $request->ip());
        });


        // Login view
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // Registration view
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // Forgot password request view
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        // Password reset form view
        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-password', ['request' => $request]);
        });


        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // Define user authentication logic
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }
        });

        // Handle user creation
        Fortify::createUsersUsing(CreateNewUser::class);
    }
}
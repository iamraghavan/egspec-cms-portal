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
use App\Mail\LoginSuccessMail;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Mail;
use Laravel\Fortify\Contracts\ConfirmPasswordViewResponse;

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

        Fortify::confirmPasswordView(fn(Request $request) => view('auth.confirm-password'));

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
                // Check if the user has two-factor authentication enabled
                if ($user->two_factor_enabled) {
                    // User has 2FA enabled; return a response indicating that 2FA is required
                    return $user;
                }

                try {
                    // Generate login details
                    $agent = new Agent();
                    $loginDetails = [
                        'date' => now()->format('F j, Y, g:i A (T)'),
                        'os' => $agent->platform(),
                        'browser' => $agent->browser(),
                        'location' => $request->ip(),
                    ];

                    // Send the email after successful login
                    Mail::to($user->email)->send(new LoginSuccessMail($user, $loginDetails));
                } catch (\Exception $e) {
                    Log::error('Email not sent: ' . $e->getMessage());
                }

                return $user; // Return the user if no 2FA is required
            }
        });

        // Handle user creation
        Fortify::createUsersUsing(CreateNewUser::class);

        // Custom two-factor challenge view
        Fortify::twoFactorChallengeView(function () {
            return view('auth.two-factor-challenge');
        });
    }
}

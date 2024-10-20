<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckRole
{
    public function handle(Request $request, Closure $next, $roleId)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized access.');
        }

        $user = Auth::user();

        // Ensure user role relationship is loaded
        if (!$user->role || $user->role->id != $roleId) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
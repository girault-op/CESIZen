<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user || !$user->is_admin || $user->status === 'disabled') {
            return redirect()->route('dashboard')->with('error', 'Accès réservé aux administrateurs.');
        }

        return $next($request);
    }
}
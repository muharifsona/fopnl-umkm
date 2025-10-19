<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsRegulator
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'Regulator') {
            abort(403, 'Akses ditolak. Hanya pengguna dengan peran Regulator yang diperbolehkan.');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsUmkm
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Pastikan user login & memiliki role 'umkm'
        if (!$user || !in_array(strtolower($user->role ?? ''), ['umkm', 'admin'])) {
            abort(403, 'Akses ditolak. Hanya pengguna UMKM yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfFilamentNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek: Apakah pengguna sudah login DAN is_admin-nya BUKAN true (atau 1)
        if (Auth::check() && !Auth::user()->is_admin) {
            // Jika ya, tendang ke halaman dashboard utama
            return redirect()->route('dashboard');
        }

        // Jika dia adalah admin atau belum login, biarkan dia melanjutkan
        return $next($request);
    }
}
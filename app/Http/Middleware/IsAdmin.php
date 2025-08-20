<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna sudah login DAN memiliki status is_admin
        if (Auth::check() && Auth::user()->is_admin) {
            // Jika ya, izinkan akses ke halaman selanjutnya
            return $next($request);
        }

        // Jika tidak, kembalikan ke halaman dashboard
        return redirect()->route('dashboard');
    }
}
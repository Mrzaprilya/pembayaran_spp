<?php

namespace App\Http\Middleware;

use Closure;

class PetugasMiddleware
{
    public function handle($request, \Closure $next)
    {
        if (session('login') && session('level') === 'petugas') {
            // user petugas sudah login, lanjut
            return $next($request);
        }

        // kalau belum login sebagai petugas, redirect ke login
        return redirect('/login');
    }
}

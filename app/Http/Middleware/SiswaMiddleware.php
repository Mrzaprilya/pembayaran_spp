<?php

namespace App\Http\Middleware;

use Closure;

class SiswaMiddleware
{
    public function handle($request, Closure $next)
{
    if (!session('login') || session('level') !== 'siswa') {
        return redirect('/login');
    }

    return $next($request);
}
}

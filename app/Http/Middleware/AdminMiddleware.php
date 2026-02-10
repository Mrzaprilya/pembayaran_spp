<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (
            session('login') === true &&
            session('level') === 'admin'
        ) {
            return $next($request);
        }

        return redirect('/login');
    }
}

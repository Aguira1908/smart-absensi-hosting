<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 🔐 Hanya admin yang boleh akses
        if (auth()->check() && auth()->user()->role == 'admin') {
            return $next($request);
        }

        return redirect('/');
    }
}
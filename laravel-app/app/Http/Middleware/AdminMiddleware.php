<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    dd(Auth::user()); // or dd(auth()->user());
    
    if (!Auth::check() || !Auth::user()->is_admin) {
        abort(403, 'Unauthorized action.');
    }

    return $next($request);
}
}
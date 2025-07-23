<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role): mixed
    {
        if (!\Illuminate\Support\Facades\Auth::check() || \Illuminate\Support\Facades\Auth::user()->role !== $role) {
            abort(403, 'Accès refusé.');
        }
        return $next($request);
    }
}

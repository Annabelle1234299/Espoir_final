<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttenteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est connecté et a le rôle entrepreneur_en_attente
        if (Auth::check() && Auth::user()->role === User::ROLE_ENTREPRENEUR_EN_ATTENTE) {
            return $next($request);
        }

        // Redirection en fonction du rôle
        if (Auth::check()) {
            if (Auth::user()->role === User::ROLE_ADMIN) {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'Accès interdit. Cette section est réservée aux entrepreneurs en attente d\'approbation.');
            } elseif (Auth::user()->role === User::ROLE_ENTREPRENEUR_APPROUVE) {
                return redirect()->route('entrepreneur.dashboard')
                    ->with('error', 'Accès interdit. Votre compte entrepreneur est déjà approuvé.');
            } else {
                return redirect()->route('dashboard')
                    ->with('error', 'Accès interdit. Vous n\'avez pas les autorisations nécessaires.');
            }
        }

        // Si l'utilisateur n'est pas connecté, redirection vers la page de connexion
        return redirect()->route('login')
            ->with('error', 'Vous devez vous connecter pour accéder à cette page.');
    }
}

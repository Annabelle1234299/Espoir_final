<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Si l'utilisateur n'est pas connecté, redirection vers la page de connexion
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Vous devez vous connecter pour accéder à cette page.');
        }
        
        $userRole = Auth::user()->role;
        
        // Vérification du rôle
        switch ($role) {
            case 'admin':
                if ($userRole !== User::ROLE_ADMIN) {
                    return $this->redirectBasedOnRole($userRole);
                }
                break;
            case 'entrepreneur':
                if ($userRole !== User::ROLE_ENTREPRENEUR_APPROUVE) {
                    return $this->redirectBasedOnRole($userRole);
                }
                break;
            case 'attente':
                if ($userRole !== User::ROLE_ENTREPRENEUR_EN_ATTENTE) {
                    return $this->redirectBasedOnRole($userRole);
                }
                break;
            default:
                return redirect()->route('dashboard')
                    ->with('error', 'Rôle non reconnu.');
        }

        return $next($request);
    }

    /**
     * Rediriger l'utilisateur en fonction de son rôle
     * 
     * @param string $userRole
     * @return \Illuminate\Http\RedirectResponse
     */
    private function redirectBasedOnRole($userRole)
    {
        switch ($userRole) {
            case User::ROLE_ADMIN:
                return redirect()->route('admin.dashboard')
                    ->with('error', 'Accès interdit. Vous êtes redirigé vers votre dashboard.');
            case User::ROLE_ENTREPRENEUR_APPROUVE:
                return redirect()->route('entrepreneur.dashboard')
                    ->with('error', 'Accès interdit. Vous êtes redirigé vers votre dashboard.');
            case User::ROLE_ENTREPRENEUR_EN_ATTENTE:
                return redirect()->route('attente.dashboard')
                    ->with('error', 'Accès interdit. Vous êtes redirigé vers votre dashboard.');
            default:
                return redirect()->route('dashboard')
                    ->with('error', 'Accès interdit. Vous n\'avez pas les autorisations nécessaires.');
        }
    }
}

<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait ChecksUserRole
{
    /**
     * Vérifie si l'utilisateur a un rôle spécifique
     *
     * @param string $role
     * @return bool
     */
    protected function hasRole(string $role): bool
    {
        if (!Auth::check()) {
            return false;
        }

        $userRole = Auth::user()->role;

        switch ($role) {
            case 'admin':
                return $userRole === User::ROLE_ADMIN;
            case 'entrepreneur':
                return $userRole === User::ROLE_ENTREPRENEUR_APPROUVE;
            case 'attente':
                return $userRole === User::ROLE_ENTREPRENEUR_EN_ATTENTE;
            default:
                return false;
        }
    }

    /**
     * Redirige l'utilisateur en fonction de son rôle actuel
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectBasedOnRole()
    {
        $userRole = Auth::user()->role;

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

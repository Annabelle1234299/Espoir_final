<?php

namespace App\Http\Controllers;

use App\Mail\EntrepreneurApproval;
use App\Models\Commande;
use App\Models\Stand;
use App\Models\User;
use App\Traits\ChecksUserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AdminController extends Controller
{
    use ChecksUserRole;
    /**
     * Afficher le tableau de bord admin.
     */
    public function dashboard()
    {
        if (!$this->hasRole('admin')) {
            return $this->redirectBasedOnRole();
        }
        $pendingStands = Stand::where('status', 'en_attente')->count();
        $approvedStands = Stand::where('status', 'approuve')->count();
        $totalStands = Stand::count();
        $totalOrders = Commande::count();
        $pendingOrders = Commande::where('status', 'en_attente')->count();
        $totalUsers = User::count();
        $pendingUsers = User::where('role', User::ROLE_ENTREPRENEUR_EN_ATTENTE)->count();
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();
        $recentOrders = Commande::with(['user', 'stand'])->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', [
            'pendingStands' => $pendingStands,
            'approvedStands' => $approvedStands,
            'totalStands' => $totalStands,
            'totalOrders' => $totalOrders,
            'pendingOrders' => $pendingOrders,
            'totalUsers' => $totalUsers,
            'pendingUsers' => $pendingUsers,
            'recentUsers' => $recentUsers,
            'recentOrders' => $recentOrders,
        ]);
    }

    /**
     * Afficher la liste des utilisateurs en attente d'approbation.
     */
    public function pendingUsers()
    {
        if (!$this->hasRole('admin')) {
            return $this->redirectBasedOnRole();
        }
        $pendingUsers = User::where('role', User::ROLE_ENTREPRENEUR_EN_ATTENTE)
            ->with('stand')
            ->get();

        return view('admin.pending-users', [
            'pendingUsers' => $pendingUsers,
        ]);
    }

    /**
     * Approuver un entrepreneur.
     */
    public function approveUser(User $user)
    {
        if (!$this->hasRole('admin')) {
            return $this->redirectBasedOnRole();
        }
        $user->update(['role' => User::ROLE_ENTREPRENEUR_APPROUVE]);
        
        $stand = null;
        if ($user->stand) {
            $stand = $user->stand;
            $stand->update(['status' => 'approuve']);
        }

        // Envoyer un e-mail de notification
        if ($stand) {
            try {
                Mail::to($user->email)->send(new EntrepreneurApproval($user, $stand));
            } catch (\Exception $e) {
                Log::error('Erreur d\'envoi d\'email d\'approbation: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'L\'entrepreneur a été approuvé avec succès. Un email de confirmation lui a été envoyé.');
    }

    /**
     * Rejeter un entrepreneur.
     */
    public function rejectUser(Request $request, User $user)
    {
        if (!$this->hasRole('admin')) {
            return $this->redirectBasedOnRole();
        }
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        if ($user->stand) {
            $user->stand->update([
                'status' => 'rejete',
                'message_rejet' => $validated['message'],
            ]);
        }

        return redirect()->back()->with('success', 'L\'entrepreneur a été rejeté.');
    }

    /**
     * Afficher toutes les commandes.
     */
    public function allOrders()
    {
        if (!$this->hasRole('admin')) {
            return $this->redirectBasedOnRole();
        }
        $orders = Commande::with(['user', 'stand'])->latest()->get();

        return view('admin.orders', [
            'orders' => $orders,
        ]);
    }
}

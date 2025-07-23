<?php

namespace App\Http\Controllers;

use App\Models\Stand;
use App\Traits\ChecksUserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AttenteController extends Controller
{
    use ChecksUserRole;
    /**
     * Afficher le tableau de bord en attente d'approbation.
     */
    public function dashboard()
    {
        if (!$this->hasRole('attente')) {
            return $this->redirectBasedOnRole();
        }
        $user = Auth::user();
        $stand = $user->stand;
        
        return view('attente.dashboard', [
            'stand' => $stand,
        ]);
    }
    
    /**
     * Afficher les détails du stand en attente.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function standDetails()
    {
        if (!$this->hasRole('attente')) {
            return $this->redirectBasedOnRole();
        }
        $stand = Auth::user()->stand;
        
        if (!$stand) {
            return redirect()->route('attente.stand.create')
                ->with('info', 'Vous devez d\'abord créer un stand pour être approuvé.');
        }
        
        return view('attente.stand-details', [
            'stand' => $stand,
        ]);
    }
    
    /**
     * Afficher le formulaire de création d'un stand.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function createStand()
    {
        if (!$this->hasRole('attente')) {
            return $this->redirectBasedOnRole();
        }
        $user = Auth::user();
        
        // Vérifier si l'utilisateur a déjà un stand
        if ($user->stand) {
            return redirect()->route('attente.stand.edit')
                ->with('info', 'Vous avez déjà créé un stand. Vous pouvez le modifier ici.');
        }
        
        return view('attente.stand.create');
    }
    
    /**
     * Enregistrer un nouveau stand.
     */
    public function storeStand(Request $request)
    {
        if (!$this->hasRole('attente')) {
            return $this->redirectBasedOnRole();
        }
        $user = Auth::user();
        
        // Vérifier si l'utilisateur a déjà un stand
        if ($user->stand) {
            return redirect()->route('attente.stand.edit')
                ->with('info', 'Vous avez déjà créé un stand. Vous pouvez le modifier ici.');
        }
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'emplacement' => 'required|string|max:255',
            'type_produits' => 'required|string|in:alimentaire,artisanat,vetements,bijoux,cosmetiques,decoration,autre',
            'infos_supplementaires' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // max 2MB
        ]);
        
        $data = [
            'nom' => $validated['nom'],
            'description' => $validated['description'],
            'emplacement' => $validated['emplacement'],
            'type_produits' => $validated['type_produits'],
            'infos_supplementaires' => $validated['infos_supplementaires'] ?? null,
            'user_id' => $user->id,
            'status' => 'en_attente', // Stand en attente d'approbation
            'visible' => false, // Par défaut, le stand n'est pas visible
        ];
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('stands', 'public');
        }
        
        $stand = Stand::create($data);
        
        return redirect()->route('attente.dashboard')
            ->with('success', 'Votre stand a été créé avec succès et est en attente d\'approbation.');
    }
    
    /**
     * Afficher le formulaire de modification d'un stand.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function editStand()
    {
        if (!$this->hasRole('attente')) {
            return $this->redirectBasedOnRole();
        }
        $user = Auth::user();
        $stand = $user->stand;
        
        if (!$stand) {
            return redirect()->route('attente.stand.create')
                ->with('error', 'Vous devez d\'abord créer un stand.');
        }
        
        return view('attente.stand.edit', [
            'stand' => $stand,
        ]);
    }
    
    /**
     * Mettre à jour un stand existant.
     */
    public function updateStand(Request $request, Stand $stand)
    {
        if (!$this->hasRole('attente')) {
            return $this->redirectBasedOnRole();
        }
        $user = Auth::user();
        
        if (!$user->stand || $stand->id !== $user->stand->id) {
            abort(403, 'Vous n\'\u00eates pas autorisé à modifier ce stand');
        }
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'emplacement' => 'required|string|max:255',
            'type_produits' => 'required|string|in:alimentaire,artisanat,vetements,bijoux,cosmetiques,decoration,autre',
            'infos_supplementaires' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // max 2MB
        ]);
        
        $data = [
            'nom' => $validated['nom'],
            'description' => $validated['description'],
            'emplacement' => $validated['emplacement'],
            'type_produits' => $validated['type_produits'],
            'infos_supplementaires' => $validated['infos_supplementaires'] ?? null,
            // Maintient le statut et la visibilité actuels
        ];
        
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($stand->image) {
                Storage::disk('public')->delete($stand->image);
            }
            
            $data['image'] = $request->file('image')->store('stands', 'public');
        }
        
        $stand->update($data);
        
        return redirect()->route('attente.dashboard')
            ->with('success', 'Votre stand a été mis à jour avec succès.');
    }
}

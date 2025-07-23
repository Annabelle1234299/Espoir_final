<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Stand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EntrepreneurController extends Controller
{
    
    /**
     * Afficher le tableau de bord entrepreneur.
     * Version simplifiée pour le module 3 - CRUD Produits pour Entrepreneur.
     */
    public function dashboard()
    {
        // Utilisation d'un stand fixe (le premier dans la BDD)
        $stand = Stand::first();
        // Fallback si aucun stand n'existe
        if (!$stand) {
            $stand = Stand::create([
                'nom' => 'Stand Démonstration',
                'description' => 'Stand pour démonstration du Module 3',
                'emplacement' => 'Zone A',
                'type_produits' => 'alimentaire'
            ]);
        }
        
        $produits = $stand->produits()->latest()->get();
        
        $totalProduits = $produits->count();
        $produitsEnStock = $produits->where('quantite', '>', 0)->count();

        $recentProduits = $produits->take(6);

        return view('entrepreneur.dashboard', [
            'stand' => $stand,
            'totalProduits' => $totalProduits,
            'produitsEnStock' => $produitsEnStock,
            'recentProduits' => $recentProduits,
        ]);
    }

    /**
     * Afficher la liste des produits de l'entrepreneur.
     *
     * @return \Illuminate\View\View
     */
    public function listProduits()
    {
        // Utiliser le stand de démonstration (le premier dans la BDD)
        $stand = Stand::first();
        if (!$stand) {
            $stand = Stand::create([
                'nom' => 'Stand Démonstration',
                'description' => 'Stand pour démonstration du Module 3',
                'emplacement' => 'Zone A',
                'type_produits' => 'alimentaire'
            ]);
        }

        $produits = $stand->produits()->latest()->paginate(10);

        return view('entrepreneur.produits.index', [
            'produits' => $produits,
            'stand' => $stand,
        ]);
    }

    /**
     * Afficher le formulaire de création d'un produit.
     *
     * @return \Illuminate\View\View
     */
    public function createProduit()
    {
        // Utiliser le stand de démonstration
        $stand = Stand::first();
        if (!$stand) {
            $stand = Stand::create([
                'nom' => 'Stand Démonstration',
                'description' => 'Stand pour démonstration du Module 3',
                'emplacement' => 'Zone A',
                'type_produits' => 'alimentaire'
            ]);
        }

        return view('entrepreneur.produits.create', [
            'stand' => $stand,
        ]);
    }

    /**
     * Enregistrer un nouveau produit.
     */
    public function storeProduit(Request $request)
    {
        // Utiliser le stand de démonstration
        $stand = Stand::first();
        if (!$stand) {
            $stand = Stand::create([
                'nom' => 'Stand Démonstration',
                'description' => 'Stand pour démonstration du Module 3',
                'emplacement' => 'Zone A',
                'type_produits' => 'alimentaire'
            ]);
        }

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'quantite' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048', // max 2MB
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produits', 'public');
        }

        Produit::create([
            'nom' => $validated['nom'],
            'description' => $validated['description'],
            'prix' => $validated['prix'],
            'quantite' => $validated['quantite'],
            'image' => $imagePath,
            'stand_id' => $stand->id,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }

    /**
     * Afficher le formulaire de modification d'un produit.
     */
    public function editProduit(Produit $produit)
    {
        // Module 3 simplifié - Pour la démonstration, nous permettons l'édition sans vérification d'appartenance
        return view('entrepreneur.produits.edit', [
            'produit' => $produit,
        ]);
    }

    /**
     * Mettre à jour un produit existant.
     */
    public function updateProduit(Request $request, Produit $produit)
    {
        // Module 3 simplifié - Pas de vérification d'appartenance pour la démonstration

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'quantite' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048', // max 2MB
        ]);

        $data = [
            'nom' => $validated['nom'],
            'description' => $validated['description'],
            'prix' => $validated['prix'],
            'quantite' => $validated['quantite'],
        ];

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($produit->image) {
                Storage::disk('public')->delete($produit->image);
            }
            
            $data['image'] = $request->file('image')->store('produits', 'public');
        }

        $produit->update($data);

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Supprimer un produit.
     */
    public function destroyProduit(Produit $produit)
    {
        // Module 3 simplifié - Pas de vérification d'appartenance pour la démonstration

        // Supprimer l'image si elle existe
        if ($produit->image) {
            Storage::disk('public')->delete($produit->image);
        }

        $produit->delete();

        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }

    // Les méthodes de gestion des commandes ont été supprimées pour ne conserver que le module 3 (CRUD Produits)

    /**
     * Afficher le détail d'un produit pour l'entrepreneur.
     */
    public function showProduit(Produit $produit)
    {
        // Module 3 simplifié - Pas de vérification d'appartenance pour la démonstration
        return view('entrepreneur.produits.show', [
            'produit' => $produit,
        ]);
    }

    // Module 3 - CRUD Produits pour Entrepreneur uniquement
}

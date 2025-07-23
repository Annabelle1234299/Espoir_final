<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\Categorie;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\Stand;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PublicController extends Controller
{
    /**
     * Afficher la page d'accueil publique.
     */
    public function index(): View
    {
        $stands = Stand::where('status', 'approuve')->latest()->take(6)->get();
        $produits = Produit::whereHas('stand', function ($query) {
            $query->where('status', 'approuve');
        })->latest()->take(8)->get();

        return view('public.index', [
            'stands' => $stands,
            'produits' => $produits,
        ]);
    }

    /**
     * Afficher tous les stands approuvés.
     */
    public function stands(): View
    {
        $stands = Stand::where('status', 'approuve')->latest()->paginate(12);

        return view('public.stands', [
            'stands' => $stands,
        ]);
    }

    /**
     * Afficher un stand spécifique et ses produits.
     */
    public function showStand(Stand $stand): View
    {
        if ($stand->status !== 'approuve') {
            abort(404);
        }
        
        // Forcer l'utilisation du chargement direct pour s'assurer que tous les produits sont bien chargés
        // sans aucun filtrage sur la quantité
        $produits = Produit::where('stand_id', $stand->id)
            ->latest()
            ->paginate(12);
        
        // Log pour debugging
        Log::info('Affichage stand #' . $stand->id . ' avec ' . $produits->count() . ' produits');

        return view('public.stand-details', [
            'stand' => $stand,
            'produits' => $produits,
        ]);
    }

    /**
     * Afficher tous les produits.
     */
    public function produits(): View
    {
        $produits = Produit::whereHas('stand', function ($query) {
            $query->where('status', 'approuve');
        })->latest()->paginate(12);

        return view('public.produits', [
            'produits' => $produits,
        ]);
    }

    /**
     * Afficher un produit spécifique.
     */
    public function showProduit(Produit $produit): View
    {
        if ($produit->stand->status !== 'approuve') {
            abort(404);
        }

        $relatedProduits = Produit::where('stand_id', $produit->stand_id)
            ->where('id', '!=', $produit->id)
            ->take(4)
            ->get();

        return view('public.produit-details', [
            'produit' => $produit,
            'relatedProduits' => $relatedProduits,
        ]);
    }

    /**
     * Rechercher des produits ou stands.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        
        $stands = Stand::where('status', 'approuve')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('nom', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            })
            ->take(5)
            ->get();
            
        $produits = Produit::whereHas('stand', function ($queryBuilder) {
                $queryBuilder->where('status', 'approuve');
            })
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('nom', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            })
            ->take(10)
            ->get();

        return view('public.search-results', [
            'query' => $query,
            'stands' => $stands,
            'produits' => $produits,
        ]);
    }

    /**
     * Ajouter un produit au panier.
     */
    public function addToCart(Request $request, Produit $produit)
    {
        if ($produit->stand->status !== 'approuve' || $produit->quantite <= 0) {
            return redirect()->back()->with('error', 'Ce produit n\'est pas disponible actuellement.');
        }

        $cart = session()->get('cart', []);
        
        // Si le produit est déjà dans le panier, augmenter la quantité
        if(isset($cart[$produit->id])) {
            $cart[$produit->id]['quantite']++;
        } else {
            // Sinon, ajouter le produit au panier
            $cart[$produit->id] = [
                "nom" => $produit->nom,
                "quantite" => 1,
                "prix" => $produit->prix,
                "image" => $produit->image,
                "stand_id" => $produit->stand_id
            ];
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Produit ajouté au panier avec succès!');
    }

    /**
     * Afficher le panier.
     */
    public function cart(): View
    {
        return view('public.cart');
    }

    /**
     * Mettre à jour le panier.
     */
    public function updateCart(Request $request)
    {
        $validated = $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        
        if(isset($cart[$validated['produit_id']])) {
            $cart[$validated['produit_id']]['quantite'] = $validated['quantite'];
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart')->with('success', 'Panier mis à jour!');
    }

    /**
     * Supprimer un produit du panier.
     */
    public function removeFromCart(Request $request)
    {
        $validated = $request->validate([
            'produit_id' => 'required|exists:produits,id',
        ]);
    
        $cart = session()->get('cart', []);
        
        if(isset($cart[$validated['produit_id']])) {
            unset($cart[$validated['produit_id']]);
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart')->with('success', 'Produit retiré du panier!');
    }

    /**
     * Afficher le formulaire de validation de commande.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showCheckout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Votre panier est vide.');
        }

        return view('public.checkout');
    }

    /**
     * Traiter la commande.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processCheckout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Votre panier est vide.');
        }

        // Grouper les produits par stand
        $standProducts = [];
        foreach ($cart as $id => $details) {
            if (!isset($standProducts[$details['stand_id']])) {
                $standProducts[$details['stand_id']] = [];
            }
            $standProducts[$details['stand_id']][$id] = $details;
        }

        // Créer une commande pour chaque stand
        foreach ($standProducts as $standId => $products) {
            $total = array_sum(array_map(function($product) {
                return $product['prix'] * $product['quantite'];
            }, $products));

            Commande::create([
                'user_id' => Auth::id(),
                'stand_id' => $standId,
                'details' => $products,
                'total' => $total,
                'status' => 'en_attente',
            ]);
        }

        // Vider le panier
        session()->forget('cart');
        
        // Envoyer un e-mail de confirmation pour chaque commande
        $user = Auth::user();
        $lastCommandes = Commande::where('user_id', $user->id)
            ->latest()
            ->take(count($standProducts))
            ->get();
            
        foreach ($lastCommandes as $commande) {
            try {
                Mail::to($user->email)->send(new OrderConfirmation($commande, $user));
            } catch (\Exception $e) {
                // Log l'erreur mais continue le processus
                \Illuminate\Support\Facades\Log::error('Erreur d\'envoi d\'email: ' . $e->getMessage());
            }
        }
        
        return redirect()->route('public.orders')->with('success', 'Commande passée avec succès! Un email de confirmation vous a été envoyé.');
    }

    /**
     * Afficher les commandes de l'utilisateur connecté.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function orders()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Récupérer l'utilisateur correctement typé et ses commandes
        $user = User::find(Auth::id());
        $commandes = $user ? $user->commandes()->with('stand')->latest()->get() : collect([]);
        
        return view('public.orders', [
            'commandes' => $commandes,
        ]);
    }

    /**
     * Afficher le détail d'une commande.
     */
    public function showOrder(Commande $commande): View
    {
        if ($commande->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('public.order-details', [
            'commande' => $commande,
        ]);
    }
}

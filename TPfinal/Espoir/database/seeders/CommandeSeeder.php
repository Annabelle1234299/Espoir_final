<?php

namespace Database\Seeders;

use App\Models\Commande;
use App\Models\Produit;
use App\Models\Stand;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les stands approuvés
        $stands = Stand::where('status', 'approuvé')->get();
        
        // Récupérer les utilisateurs clients (sans rôle d'entrepreneur ou d'admin)
        $clients = User::whereNull('role')->orWhere('role', '!=', User::ROLE_ADMIN)
                       ->where('role', '!=', User::ROLE_ENTREPRENEUR_APPROUVE)
                       ->where('role', '!=', User::ROLE_ENTREPRENEUR_EN_ATTENTE)
                       ->get();
        
        // Statuts possibles pour les commandes
        $statuts = ['en_attente', 'en_preparation', 'pret', 'livre', 'annule'];
        
        // Générer 200 commandes
        for ($i = 0; $i < 200; $i++) {
            // Sélectionner un client au hasard
            $client = $clients->random();
            
            // Sélectionner un stand au hasard
            $stand = $stands->random();
            
            // Récupérer des produits du stand (entre 1 et 5 produits)
            $produits = Produit::where('stand_id', $stand->id)->inRandomOrder()->take(rand(1, 5))->get();
            
            if ($produits->count() > 0) {
                // Préparer les détails de la commande
                $details = [];
                $total = 0;
                
                foreach ($produits as $produit) {
                    $quantite = rand(1, 3);
                    $sousTotal = $produit->prix * $quantite;
                    
                    $details[] = [
                        'produit_id' => $produit->id,
                        'nom' => $produit->nom,
                        'prix_unitaire' => (float) $produit->prix,
                        'quantite' => $quantite,
                        'sous_total' => (float) $sousTotal
                    ];
                    
                    $total += $sousTotal;
                }
                
                // Date de commande aléatoire dans les 30 derniers jours
                $dateCommande = now()->subDays(rand(0, 30))->subHours(rand(0, 24))->subMinutes(rand(0, 60));
                
                // Créer la commande
                Commande::create([
                    'user_id' => $client->id,
                    'stand_id' => $stand->id,
                    'details' => $details,
                    'total' => $total,
                    'status' => $statuts[array_rand($statuts)],
                    'created_at' => $dateCommande,
                    'updated_at' => $dateCommande->copy()->addMinutes(rand(5, 180))
                ]);
            }
        }
    }
}

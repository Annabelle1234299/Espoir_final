<?php

namespace Database\Seeders;

use App\Models\Produit;
use App\Models\Stand;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les stands approuvés
        $stands = Stand::where('status', 'approuve')->get();
        
        // Catégories de produits pour le festival gastronomique
        $categories = [
            'Plats' => [
                ['nom' => 'Risotto aux champignons', 'prix' => 15.99],
                ['nom' => 'Burger gourmet', 'prix' => 13.50],
                ['nom' => 'Paella traditionnelle', 'prix' => 16.99],
                ['nom' => 'Poulet tikka masala', 'prix' => 14.75],
                ['nom' => 'Pâtes à la carbonara', 'prix' => 12.50],
                ['nom' => 'Tajine d\'agneau', 'prix' => 17.99],
                ['nom' => 'Pizza artisanale', 'prix' => 14.50],
                ['nom' => 'Ramen traditionnel', 'prix' => 13.99],
                ['nom' => 'Salade César', 'prix' => 9.99],
                ['nom' => 'Couscous royal', 'prix' => 18.50],
            ],
            'Desserts' => [
                ['nom' => 'Tiramisu maison', 'prix' => 7.50],
                ['nom' => 'Crème brûlée', 'prix' => 6.99],
                ['nom' => 'Mousse au chocolat', 'prix' => 6.50],
                ['nom' => 'Tarte aux fruits', 'prix' => 5.99],
                ['nom' => 'Cheesecake', 'prix' => 7.99],
                ['nom' => 'Crêpes sucrées', 'prix' => 6.75],
                ['nom' => 'Mochi glacé', 'prix' => 8.50],
                ['nom' => 'Panna cotta', 'prix' => 6.25],
                ['nom' => 'Gâteau au chocolat fondant', 'prix' => 7.25],
                ['nom' => 'Macaron assorti', 'prix' => 2.50],
            ],
            'Boissons' => [
                ['nom' => 'Cocktail signature', 'prix' => 9.50],
                ['nom' => 'Vin local au verre', 'prix' => 7.99],
                ['nom' => 'Bière artisanale', 'prix' => 6.50],
                ['nom' => 'Thé glacé maison', 'prix' => 4.99],
                ['nom' => 'Smoothie aux fruits frais', 'prix' => 5.75],
                ['nom' => 'Café spécialité', 'prix' => 3.99],
                ['nom' => 'Jus pressé minute', 'prix' => 5.50],
                ['nom' => 'Limonade artisanale', 'prix' => 4.75],
                ['nom' => 'Eau aromatisée', 'prix' => 3.50],
                ['nom' => 'Kombucha maison', 'prix' => 6.25],
            ],
            'Spécialités' => [
                ['nom' => 'Planche de fromages', 'prix' => 15.99],
                ['nom' => 'Tapas mixtes', 'prix' => 17.50],
                ['nom' => 'Plateau de sushis', 'prix' => 22.99],
                ['nom' => 'Assiette de charcuterie', 'prix' => 16.75],
                ['nom' => 'Plateau de fruits de mer', 'prix' => 29.99],
                ['nom' => 'Mezze libanais', 'prix' => 18.50],
                ['nom' => 'Assortiment d\'antipasti', 'prix' => 16.99],
                ['nom' => 'Nachos gourmets', 'prix' => 12.50],
                ['nom' => 'Dim sum variés', 'prix' => 15.75],
                ['nom' => 'Fondue savoyarde', 'prix' => 24.99],
            ]
        ];
        
        // Pour chaque stand approuvé
        foreach ($stands as $stand) {
            // Générer entre 5 et 15 produits par stand
            $nbProduits = rand(5, 15);
            
            for ($i = 0; $i < $nbProduits; $i++) {
                // Choisir une catégorie au hasard
                $categorie = array_rand($categories);
                // Choisir un produit au hasard dans cette catégorie
                $produit = $categories[$categorie][array_rand($categories[$categorie])];
                
                // Ajuster légèrement le prix pour avoir des variations
                $prix = $produit['prix'] * (rand(90, 110) / 100);
                
                // Créer le produit avec une description personnalisée
                Produit::create([
                    'nom' => $produit['nom'],
                    'description' => 'Un délicieux ' . strtolower($produit['nom']) . ' préparé par ' . $stand->nom . '. ' .
                                    'Fait avec des ingrédients ' . 
                                    collect(['locaux', 'bio', 'de saison', 'premium', 'artisanaux'])->random() . '.',
                    'prix' => round($prix, 2),
                    'quantite' => rand(10, 100),
                    'image' => 'produits/' . strtolower(str_replace(' ', '_', $produit['nom'])) . '.jpg',
                    'stand_id' => $stand->id,
                ]);
            }
        }
    }
}

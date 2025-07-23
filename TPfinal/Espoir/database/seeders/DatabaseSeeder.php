<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ordre important : d'abord les utilisateurs, puis les stands, etc.
        $this->call([
            UserSeeder::class,      // Crée tous les types d'utilisateurs
            StandSeeder::class,     // Crée des stands pour les entrepreneurs
            ProduitSeeder::class,   // Crée des produits pour les stands approuvés
            CommandeSeeder::class,  // Crée des commandes de produits
        ]);
    }
}

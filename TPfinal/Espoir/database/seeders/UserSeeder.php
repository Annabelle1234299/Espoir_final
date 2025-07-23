<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un utilisateur admin
        if (!User::where('email', 'admin@eatdrink.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@eatdrink.com',
                'password' => Hash::make('password'),
                'role' => User::ROLE_ADMIN,
                'email_verified_at' => now(),
            ]);
        }

        // Créer un utilisateur client normal
        if (!User::where('email', 'client@example.com')->exists()) {
            User::create([
                'name' => 'Client Test',
                'email' => 'client@example.com',
                'password' => Hash::make('password'),
                'role' => 'client', // Utilisation d'un rôle 'client' explicite au lieu de null
                'email_verified_at' => now(),
            ]);
        }

        // Créer 15 entrepreneurs approuvés
        for ($i = 1; $i <= 15; $i++) {
            $email = 'entrepreneur' . $i . '@example.com';
            if (!User::where('email', $email)->exists()) {
                User::create([
                    'name' => 'Entrepreneur ' . $i,
                    'email' => 'entrepreneur' . $i . '@example.com',
                    'password' => Hash::make('password'),
                    'role' => User::ROLE_ENTREPRENEUR_APPROUVE,
                    'email_verified_at' => now(),
                ]);
            }
        }

        // Créer 10 entrepreneurs en attente
        for ($i = 1; $i <= 10; $i++) {
            $email = 'attente' . $i . '@example.com';
            if (!User::where('email', $email)->exists()) {
                User::create([
                    'name' => 'En Attente ' . $i,
                    'email' => 'attente' . $i . '@example.com',
                    'password' => Hash::make('password'),
                    'role' => User::ROLE_ENTREPRENEUR_EN_ATTENTE,
                    'email_verified_at' => now(),
                ]);
            }
        }

        // Créer quelques clients normaux s'il n'y en a pas assez
        $clientCount = User::where('role', 'client')->count();
        $remainingCount = max(0, 50 - $clientCount);
        if ($remainingCount > 0) {
            User::factory()->count($remainingCount)->create([
                'role' => 'client', // Spécifier le rôle pour tous les utilisateurs factory
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Stand;
use App\Models\User;
use Illuminate\Database\Seeder;

class StandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les entrepreneurs approuvés
        $entrepreneursApprouves = User::where('role', User::ROLE_ENTREPRENEUR_APPROUVE)->get();
        
        // Créer un stand pour chaque entrepreneur approuvé
        foreach ($entrepreneursApprouves as $entrepreneur) {
            Stand::create([
                'nom' => 'Stand de ' . $entrepreneur->name,
                'description' => 'Description détaillée du stand de ' . $entrepreneur->name . '. Spécialités culinaires, histoire et valeurs de l\'entreprise.',
                'emplacement' => 'Zone ' . chr(rand(65, 70)) . ' - Emplacement ' . rand(1, 20),
                'user_id' => $entrepreneur->id,
                'status' => 'approuve',
                'message_rejet' => null,
            ]);
        }
        
        // Récupérer les entrepreneurs en attente
        $entrepreneursEnAttente = User::where('role', User::ROLE_ENTREPRENEUR_EN_ATTENTE)->get();
        
        // Créer un stand pour la moitié des entrepreneurs en attente
        foreach ($entrepreneursEnAttente->take(ceil($entrepreneursEnAttente->count() / 2)) as $entrepreneur) {
            Stand::create([
                'nom' => 'Stand de ' . $entrepreneur->name . ' (en attente)',
                'description' => 'Demande de stand en cours d\'approbation. Spécialité: ' . 
                    collect(['Cuisine française', 'Cuisine italienne', 'Cuisine asiatique', 'Pâtisserie', 'Cuisine africaine', 'Boissons artisanales'])->random(),
                'emplacement' => null, // Pas encore assigné
                'user_id' => $entrepreneur->id,
                'status' => 'en_attente',
                'message_rejet' => null,
            ]);
        }
        
        // Créer un stand rejeté pour l'autre moitié des entrepreneurs en attente
        foreach ($entrepreneursEnAttente->skip(ceil($entrepreneursEnAttente->count() / 2)) as $entrepreneur) {
            Stand::create([
                'nom' => 'Stand de ' . $entrepreneur->name . ' (rejeté)',
                'description' => 'Description incomplète ou ne respectant pas les critères du festival.',
                'emplacement' => null,
                'user_id' => $entrepreneur->id,
                'status' => 'rejete',
                'message_rejet' => 'Votre demande ne correspond pas aux critères du festival. Merci de fournir plus de détails sur vos produits et de respecter notre charte culinaire.',
            ]);
        }
    }
}

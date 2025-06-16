<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\BreathingMode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::factory(10)->create();
        $this->call(PostsSeeder::class);
        
        // Créez un utilisateur avec des données spécifiques
        // Assurez-vous que le mot de passe est haché
        // Utilisez Hash::make() pour hacher le mot de passe

        try {
            $specificUser = User::create([
                'lastname' => 'Laurine',
                'firstname' => 'Girault',
                'password' => Hash::make('felix120'),
                'email' => 'laurine.girault@gmail.com',
                'role' => '1',
                'status' => '1',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);

     // Message de succès
     $this->command->info('Utilisateur spécifique créé avec succès.');
    } catch (\Exception $e) {
        // Log de l'erreur
        $this->command->error('Erreur lors de la création de l\'utilisateur : ' . $e->getMessage());
    }
    $modes = [
        ['label' => 'Relaxation', 'inspiration_time' => 4, 'apnea_time' => 2, 'exhalation_time' => 6],
        ['label' => 'Concentration', 'inspiration_time' => 5, 'apnea_time' => 3, 'exhalation_time' => 7],
        ['label' => 'Energie', 'inspiration_time' => 3, 'apnea_time' => 1, 'exhalation_time' => 4],
    ];
    foreach ($modes as $mode) {
        BreathingMode::create($mode);
    }
    $this->command->info('Modes de respiration créés avec succès.');
    $users = User::all();
    $breathingModes = BreathingMode::all();

    foreach ($users as $user) {
        $user->breathingModes()->attach(
            $breathingModes->random(rand(1, 3))->pluck('id')->toArray(),
            ['usage_count' => rand(1, 10)]
        );
    }
        $this->command->info('Modes de respiration associés aux utilisateurs.');
    }
}
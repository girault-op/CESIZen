<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;

class PostsSeeder extends Seeder
{
    public function run()
    {
        // Création ou récupération des catégories
        $catYoga = Category::firstOrCreate(['label' => 'Yoga']);
        $catMeditation = Category::firstOrCreate(['label' => 'Méditation']);
        $catSante = Category::firstOrCreate(['label' => 'Santé']);

        // Création des posts avec référence aux catégories
        Post::create([
            'title' => 'Bien-être à Travers une Activité Physique : Le Yoga',
            'content' => 'Dans un monde où le stress et les préoccupations du quotidien prennent une place importante, il est essentiel de trouver une activité permettant de se recentrer...',
            'picture' => 'https://source.unsplash.com/random/600x400/?yoga',
            'category_id' => $catYoga->id,
            'is_published' => 1,
        ]);

        Post::create([
            'title' => 'Bien-être : Clé d\'une Vie Équilibrée et Épanouie',
            'content' => 'Le bien-être est un état d\'harmonie physique, mentale et émotionnelle qui contribue à une vie plus équilibrée et satisfaisante...',
            'picture' => 'https://source.unsplash.com/random/600x400/?meditation',
            'category_id' => $catMeditation->id,
            'is_published' => 1,
        ]);

        Post::create([
            'title' => 'Les Bienfaits du Yoga pour le Corps et l’Esprit',
            'content' => 'Le yoga est une pratique ancienne qui combine des postures physiques, des techniques de respiration et de méditation pour améliorer la santé globale...',
            'picture' => 'https://source.unsplash.com/random/600x400/?yoga,meditation',
            'category_id' => $catYoga->id,
            'is_published' => 1,
        ]);

        Post::create([
            'title' => '10 Conseils pour Réduire le Stress au Quotidien',
            'content' => 'Le stress peut avoir des effets négatifs sur la santé. Découvrez 10 conseils pratiques pour réduire le stress et améliorer votre qualité de vie...',
            'picture' => 'https://source.unsplash.com/random/600x400/?stress,relaxation',
            'category_id' => $catSante->id,
            'is_published' => 1,
        ]);

        Post::create([
            'title' => 'Comment la Méditation Peut Transformer Votre Vie',
            'content' => 'La méditation est une pratique puissante pour calmer l’esprit, réduire le stress et améliorer la concentration. Apprenez comment commencer dès aujourd’hui...',
            'picture' => 'https://source.unsplash.com/random/600x400/?meditation,peace',
            'category_id' => $catMeditation->id,
            'is_published' => 1,
        ]);

        Post::create([
            'title' => 'Les Aliments Qui Boostent Votre Énergie',
            'content' => 'Une alimentation équilibrée est essentielle pour maintenir un niveau d’énergie optimal. Découvrez les aliments qui vous aident à rester actif toute la journée...',
            'picture' => 'https://source.unsplash.com/random/600x400/?healthy-food',
            'category_id' => $catSante->id,
            'is_published' => 1,
        ]);

        Post::create([
            'title' => 'Les Secrets d’un Sommeil Réparateur',
            'content' => 'Un bon sommeil est crucial pour la santé physique et mentale. Découvrez les astuces pour améliorer la qualité de votre sommeil...',
            'picture' => 'https://source.unsplash.com/random/600x400/?sleep,bed',
            'category_id' => $catMeditation->id,
            'is_published' => 1,
        ]);

        Post::create([
            'title' => 'Les Étirements : Une Routine Essentielle pour Votre Bien-être',
            'content' => 'Les étirements permettent de réduire les tensions musculaires, d’améliorer la flexibilité et de prévenir les blessures. Intégrez-les à votre quotidien...',
            'picture' => 'https://source.unsplash.com/random/600x400/?stretching',
            'category_id' => $catYoga->id,
            'is_published' => 1,
        ]);
    }
}

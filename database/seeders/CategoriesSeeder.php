<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;


class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['label' => 'Technologie'],
            ['label' => 'Santé'],
            ['label' => 'Éducation'],
            ['label' => 'Voyage'],
            ['label' => 'Cuisine'],
            ['label' => 'Sport'],
            ['label' => 'Art'],
            ['label' => 'Musique'],
            ['label' => 'Mode'],
            ['label' => 'Finance'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

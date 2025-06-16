<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BreathingMode>
 */

class BreathingModeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    protected $model = \App\Models\BreathingMode::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'label' => fake()->word(),
            'inspiration_time' => fake()->numberBetween(1, 10),
            'apnea_time' => fake()->numberBetween(1, 10),
            'exhalation_time' => fake()->numberBetween(1, 10),
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
        ];
    }
}
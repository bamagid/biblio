<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Emprunt>
 */
class EmpruntFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 3,
            'livre_id' => $this->faker->numberBetween(1, 5),
            'date_emprunt' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'date_retour_prevue' => $this->faker->dateTimeBetween('now', '+2 weeks'),
            'date_retour_reelle' => null,
        ];
    }
}

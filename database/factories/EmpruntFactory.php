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
            "user_id" => $this->faker->numberBetween(1, 6),
            "livre_id" => $this->faker->numberBetween(1, 10),
            "date_emprunt" => $this->faker->dateTimeBetween('-30 days', 'now'),
            "date_retour_prevue" => $this->faker->dateTimeBetween('now', '+30 days'),
            "date_retour_reelle" => null
        ];
    }
}

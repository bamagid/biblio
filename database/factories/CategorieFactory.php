<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categorie>
 */
class CategorieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Roman', 'Poésie', 'Science-fiction', 'Histoire', 'Biographie', 'Philosophie', 'Religion', 'Art', 'Théâtre', 'Économie', 'Politique', 'Sociologie'
        ];
        return [
            'nom' => $this->faker->randomElement($categories),
            'description' => $this->faker->text(200),
            'created_at' => now(),
            "updated_at" => now(),
        ];
    }
}

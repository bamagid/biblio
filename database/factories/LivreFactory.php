<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livre>
 */
class LivreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $livres = [
            ['titre' => 'Les Petits Enfants de la rue', 'auteur' => 'Léopold Sédar Senghor'],
            ['titre' => 'De la démocratie en Amérique', 'auteur' => 'Alexis de Tocqueville'],
            ['titre' => 'La voie de la voix', 'auteur' => 'Cheikh Anta Diop'],
            ['titre' => 'Americanah', 'auteur' => 'Chimamanda Ngozi Adichie'],
            ['titre' => 'Les Soleils des indépendances', 'auteur' => 'Ahmadou Kourouma'],
            ['titre' => 'Le Vieux Nègre et la Médaille', 'auteur' => 'Ferdinand Oyono'],
            ['titre' => 'Kiffe Kiffe Demain', 'auteur' => 'Faïza Guène'],
            ['titre' => 'Rich Dad Poor Dad', 'auteur' => 'Robert Kiyosaki'],
            ['titre' => 'L’Aventure ambiguë', 'auteur' => 'Cheikh Hamidou Kane'],
            ['titre' => 'Le baobab fou', 'auteur' => 'Ken Bugul'],
            ['titre' => 'Un si long chemin', 'auteur' => 'Nelson Mandela'],
        ];

        $livre = $this->faker->randomElement($livres);
        return [
            "titre" => $livre["titre"],
            "auteur" => $livre["auteur"],
            "isbn" => $this->faker->isbn13(),
            "categorie_id" => $this->faker->numberBetween(1, 8),
            "date_publication" => $this->faker->dateTimeBetween("-30 years", "now"),
            "quantite" => $this->faker->numberBetween(1, 20),
            "disponible" => true,
            "created_at" => now(),
            "updated_at" => now(),
        ];
    }
}

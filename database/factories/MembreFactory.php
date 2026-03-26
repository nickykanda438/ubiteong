<?php

namespace Database\Factories;

use App\Models\Membre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Membre>
 */
class MembreFactory extends Factory
{
    /**
     * Le nom du modèle correspondant.
     *
     * @var string
     */
    protected $model = Membre::class;

    /**
     * Définition de l'état par défaut du modèle.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genre = $this->faker->randomElement(['Masculin', 'Féminin']);
        
        return [
            // Identifiant unique (Ex: EG-RDC-2026-452)
            'numero_membre'  => 'EG-RDC-2026-' . $this->faker->unique()->numberBetween(100, 999),
            
            // Identité (Nom en majuscules pour le réalisme)
            'nom_complet'    => strtoupper($this->faker->lastName . ' ' . $this->faker->firstName($genre)),
            'genre'          => $genre,
            'date_naissance' => $this->faker->date('Y-m-d', '-20 years'), // Personnes de + de 20 ans
            'lieu_naissance' => $this->faker->city,
            'profession'     => $this->faker->jobTitle,
            
            // Coordonnées
            'adresse_membre' => $this->faker->streetAddress . ', ' . $this->faker->city,
            
            // Statut ONG
            'type_membre'    => $this->faker->randomElement(['Membre effectif', 'Membre sympathisant', 'Membre d’honneur']),
            'fonction'       => $this->faker->randomElement(['Coordinateur', 'Secrétaire', 'Chargé de Projets', 'Membre simple', 'Trésorier']),
            
            // Qualité : On met une valeur par défaut au lieu de null pour éviter les erreurs SQL
            'qualite'        => $this->faker->randomElement(['Fondateur', 'Donateur', 'Bénévole', 'Sympathisant', 'Adhérent']),
            
            // Dates
            'date_adhesion'  => $this->faker->dateTimeBetween('-3 years', 'now')->format('Y-m-d'),
            
            // Photo : Un chemin fictif pour éviter l'erreur "ne peut être vide"
            'photo_membre'   => 'photos/default_avatar.png',
        ];
    }
}
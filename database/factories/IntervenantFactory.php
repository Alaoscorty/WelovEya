<?php

namespace Database\Factories;

use App\Models\Intervenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class IntervenantFactory extends Factory
{
    protected $model = Intervenant::class;

    public function definition()
    {
        static $counter = 1;

        return [
            'code' => 'INT-' . str_pad($counter++, 3, '0', STR_PAD_LEFT),
            'nom' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'role' => $this->faker->randomElement(['artiste', 'animateur', 'dj']),
            'statut' => $this->faker->randomElement(['en_attente', 'confirme']),
            'heure' => $this->faker->time('H:i'),
            'date' => $this->faker->date(),
            'photo' => null,
        ];
    }
}

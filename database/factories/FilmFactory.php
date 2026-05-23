<?php

namespace Database\Factories;

use App\Models\Director;
use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilmFactory extends Factory
{
    protected $model = Film::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'release_date' => fake()->date('Y-m-d'),
            'sinopsis' => fake()->paragraph(),
            'duration' => fake()->numberBetween(80, 240),
            'gendre' => fake()->randomElement(['Acción', 'Comedia', 'Drama', 'Terror', 'Ciencia Ficción']),
            'director_id' => Director::factory(),
        ];
    }
}

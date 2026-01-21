<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
            'Electronica',
            'Ropa y Moda',
            'Hogar y jardin',
            'Deportes',
            'Juguetes',
            'Libros',
            'Alimentos y Bebidas',
            'Belleza y ciudad',
            'Automoviles',
            'Mascotas',
            'Musica',
            'Peliculas y series',
            'Oficina y Papeles',
            'Bebes',
            'Salud y Bienestar'
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->optional(0.7)->sentence(15),
        ];
    }
}

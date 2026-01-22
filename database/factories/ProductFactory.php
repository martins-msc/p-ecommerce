<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //precios base para calculos realistas
        $purchase_price = $this->faker->randomFloat(2, 10, 500);
        $margenGanancia = $this->faker->randomElement([0.15, 0.20, 0.25, 0.30, 0.35, 0.40]); //15% - 40%
        $sale_price = $purchase_price * (1 + $margenGanancia);
        // generar unique code
        $code = 'PROD' . $this->faker->unique()->numberBetween(1000, 9999);
        $ElectronicNames = [
            'Smartphone Samsung Galaxy', 'Laptop Dell Inspiron', 'Tablet iPad Air',
            'Smart TV 55" 4k', 'Auriculares inalambricos', 'Smartwatch Apple',
            'Camara DSLR Canon', 'Altavoz Bluetooth JBL', 'Monitor Gaming 27',
            'Teclado mecanico RGB', 'Mouse Inalambrico', 'Impresora multifuncional'
        ];
        $clotheNames = [
            'Camiseta Basica Algodon', 'Jeans Slim Fit', 'Sudadera con capucha',
            'Zapatos deportivos Running', 'Chaqueta Denim', 'Vestido casual',
            'Polo clasico', 'Shorts deportivos', 'Chamarra de cuero',
            'Falta Plisada', 'Blusa elegante', 'Traje Formal'
        ];
        $Homenames = [
            'Juego de Sabanas King', 'Cafetera Programable', 'Licuadora de 8 velocidades',
            'Aspiradora Robot', 'Juego de Ollas Antiadherentes', 'Microondas Digital',
            'Batidora de mano', 'Tostador de 4 Ranuras', 'Jarra electrica',
            'Set de Cubiertos Acero', 'Olla de Coccion Lenta', 'Freidora de aire'
        ];
        $sportsName = [
            'Pelota de futbol profesional', 'Raqueta de tenis', 'Bicicleta de montana',
            'Mancuernas Ajustables', 'Colchoneta Yoga', 'Cinta para Correr',
            'Set de golf', 'Balon de Baloncesto', 'Pesas Rusas',
            'Cuerda para Saltar', 'Bandas de Resistencia', 'Reloj Deportivo'
        ];

        $allNames = array_merge(
            $ElectronicNames,
            $clotheNames,
            $Homenames,
            $sportsName
        );

        $name = $this->faker->randomElement($allNames) . ' ' .
            $this->faker->randomElement(['Pro', 'Max', 'Plis', 'Elite', 'Premium', 'Standard']);
        return [
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory()->create()->id,
            'name' => $name,
            'code' => $code,
            'short_description' => $this->faker->sentence(8),
            'long_description'=> $this->faker->paragraph(3, true),
            'purchase_price' => $purchase_price,
            'sale_price' => $sale_price,
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Matic', 'Sport', 'Cub', 'Off-Road', 'Big Bike', 'Electric'];
        $brands = ['Honda', 'Yamaha', 'Suzuki', 'Kawasaki', 'Vespa', 'Ducati', 'BMW', 'KTM'];
        $models = ['Vario', 'Beat', 'NMAX', 'PCX', 'CBR', 'Ninja', 'R15', 'GSX', 'Vespa Sprint', 'Primavera', 'KLX', 'CRF', 'Panigale', 'S1000RR'];
        
        $name = fake()->randomElement($brands) . ' ' . fake()->randomElement($models) . ' ' . fake()->numberBetween(2020, 2024);
        
        return [
            'name'        => $name,
            'sku'         => strtoupper(fake()->unique()->lexify('MTR-????-????')),
            'description' => fake()->sentence(),
            'price'       => fake()->randomFloat(0, 15000000, 500000000), // Prices in IDR for realism
            'stock'       => fake()->numberBetween(1, 50),
            'category'    => fake()->randomElement($categories),
            'is_active'   => true,
        ];
    }
}

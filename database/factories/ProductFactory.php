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
        $categories = ['Software', 'Hardware', 'Service', 'Consulting', 'License'];
        $name = fake()->unique()->words(3, true);
        
        return [
            'name'        => ucfirst($name),
            'sku'         => strtoupper(fake()->unique()->lexify('PROD-????-????')),
            'description' => fake()->sentence(),
            'price'       => fake()->randomFloat(2, 50, 5000),
            'stock'       => fake()->numberBetween(0, 1000),
            'category'    => fake()->randomElement($categories),
            'is_active'   => true,
        ];
    }
}

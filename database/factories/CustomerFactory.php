<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        $cities = [
            'Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang',
            'Makassar', 'Palembang', 'Tangerang', 'Depok', 'Bekasi',
            'Bogor', 'Yogyakarta', 'Malang', 'Batam', 'Denpasar',
        ];

        $provinces = [
            'DKI Jakarta', 'Jawa Timur', 'Jawa Barat', 'Sumatera Utara',
            'Jawa Tengah', 'Sulawesi Selatan', 'Sumatera Selatan', 'Banten',
            'DI Yogyakarta', 'Bali', 'Kalimantan Timur', 'Riau',
        ];

        return [
            'name'     => fake()->name(),
            'email'    => fake()->unique()->safeEmail(),
            'phone'    => fake()->numerify('08##########'),
            'address'  => fake()->streetAddress(),
            'city'     => fake()->randomElement($cities),
            'province' => fake()->randomElement($provinces),
            'gender'   => fake()->randomElement(['male', 'female']),
        ];
    }
}

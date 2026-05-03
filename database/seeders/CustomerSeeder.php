<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $total     = 500;
        $chunkSize = 100;

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

        $this->command->info("Seeding {$total} customers...");

        for ($i = 0; $i < $total / $chunkSize; $i++) {
            $customers = [];
            for ($j = 0; $j < $chunkSize; $j++) {
                $customers[] = [
                    'name'       => fake()->name(),
                    'email'      => fake()->unique()->safeEmail(),
                    'phone'      => fake()->numerify('08##########'),
                    'address'    => fake()->streetAddress(),
                    'city'       => fake()->randomElement($cities),
                    'province'   => fake()->randomElement($provinces),
                    'gender'     => fake()->randomElement(['male', 'female']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            Customer::insert($customers);
            $this->command->info('  Processed ' . (($i + 1) * $chunkSize) . " / {$total}");
        }

        $this->command->info('✓ CustomerSeeder done.');
    }
}

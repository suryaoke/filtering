<?php

namespace Database\Seeders;

use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Database\Seeder;

class PenjualanSeeder extends Seeder
{
    /**
     * Seed the penjualans table (10.000 data).
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();

        // Buat 10.000 penjualan dalam batch 500
        $totalBatches = 20;
        $perBatch = 500;

        for ($i = 0; $i < $totalBatches; $i++) {
            Penjualan::factory()
                ->count($perBatch)
                ->create([
                    'user_id' => fn () => fake()->randomElement($userIds),
                ]);

            $created = ($i + 1) * $perBatch;
            $this->command->info("   📦 Penjualan: {$created} / 10000");
        }

        $this->command->info('✅ 10.000 penjualan created');
    }
}

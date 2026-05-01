<?php

namespace Database\Seeders;

use App\Models\History;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
    /**
     * Seed the histories table.
     * Setiap penjualan mendapat 1-5 history (rata-rata ~3).
     * Total estimasi: ~30.000 history.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $totalPenjualan = Penjualan::count();
        $chunkSize = 500;
        $totalCreated = 0;

        Penjualan::select('id')->orderBy('id')->chunk($chunkSize, function ($penjualans) use ($userIds, &$totalCreated, $totalPenjualan) {
            foreach ($penjualans as $penjualan) {
                $jumlahHistory = fake()->numberBetween(1, 5);

                History::factory()
                    ->count($jumlahHistory)
                    ->create([
                        'penjualan_id' => $penjualan->id,
                        'user_id' => fn () => fake()->randomElement($userIds),
                    ]);

                $totalCreated++;
            }

            $this->command->info("   📜 History: processed {$totalCreated} / {$totalPenjualan} penjualans");
        });

        $totalHistory = History::count();
        $this->command->info("✅ {$totalHistory} histories created");
    }
}

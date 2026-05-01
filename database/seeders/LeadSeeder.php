<?php

namespace Database\Seeders;

use App\Models\History;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Seed the leads table.
     * ~40% penjualan menghasilkan lead (melalui history).
     * Total estimasi: ~4.000 leads.
     */
    public function run(): void
    {
        $salesIds = User::where('role', 'sales')->pluck('id')->toArray();

        // Ambil history yang unik per penjualan_id (ambil ~40% penjualan)
        $histories = History::select('id', 'penjualan_id')
            ->inRandomOrder()
            ->limit(4000)
            ->get()
            ->unique('penjualan_id')
            ->values();

        $totalLeads = $histories->count();
        $created = 0;

        foreach ($histories->chunk(500) as $chunk) {
            foreach ($chunk as $history) {
                Lead::factory()->create([
                    'history_id' => $history->id,
                    'penjualan_id' => $history->penjualan_id,
                    'sales_id' => fake()->randomElement($salesIds),
                ]);

                $created++;
            }

            $this->command->info("   🎯 Lead: {$created} / {$totalLeads}");
        }

        $this->command->info("✅ {$created} leads created");
    }
}

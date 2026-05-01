<?php

namespace Database\Seeders;

use App\Models\Followup;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Seeder;

class FollowupSeeder extends Seeder
{
    /**
     * Seed the followups table.
     * Setiap lead mendapat 1-4 followup.
     * Total estimasi: ~10.000 followups.
     */
    public function run(): void
    {
        $salesIds = User::where('role', 'sales')->pluck('id')->toArray();
        $totalLeads = Lead::count();
        $created = 0;
        $processedLeads = 0;

        Lead::select('id', 'sales_id')->orderBy('id')->chunk(500, function ($leads) use ($salesIds, &$created, &$processedLeads, $totalLeads) {
            foreach ($leads as $lead) {
                $jumlahFollowup = fake()->numberBetween(1, 4);

                Followup::factory()
                    ->count($jumlahFollowup)
                    ->create([
                        'lead_id' => $lead->id,
                        'sales_id' => $lead->sales_id ?? fake()->randomElement($salesIds),
                    ]);

                $created += $jumlahFollowup;
                $processedLeads++;
            }

            $this->command->info("   📞 Followup: processed {$processedLeads} / {$totalLeads} leads ({$created} followups)");
        });

        $this->command->info("✅ {$created} followups created");
    }
}

<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Followup;
use Illuminate\Database\Seeder;

class FollowupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalLeads = Lead::count();
        
        $this->command->info("Seeding followups for leads...");

        Lead::select('id', 'sales_id')->chunk(100, function ($leads) {
            $followups = [];
            foreach ($leads as $lead) {
                $count = rand(1, 2);
                for ($i = 0; $i < $count; $i++) {
                    $followups[] = [
                        'lead_id'           => $lead->id,
                        'sales_id'          => $lead->sales_id,
                        'method'            => fake()->randomElement(['Call', 'Email', 'WhatsApp', 'Visit']),
                        'note'              => fake()->sentence(10),
                        'result'            => fake()->sentence(5),
                        'status'            => fake()->randomElement(['Interested', 'Not Interested', 'Call Back']),
                        'followup_date'     => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
                        'next_schedule'     => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d H:i:s'),
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    ];
                }
            }
            Followup::insert($followups);
        });
    }
}

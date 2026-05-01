<?php

namespace Database\Seeders;

use App\Models\History;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalHistories = History::count();
        
        $this->command->info("Seeding leads for histories...");

        History::select('id', 'sale_id', 'user_id')->chunk(200, function ($histories) {
            $leads = [];
            foreach ($histories as $history) {
                if (rand(1, 10) > 7) {
                    $leads[] = [
                        'history_id'        => $history->id,
                        'sale_id'           => $history->sale_id,
                        'sales_id'          => $history->user_id,
                        'lead_name'         => fake()->name(),
                        'product_interest'  => fake()->word(),
                        'priority'          => fake()->randomElement(['Low', 'Medium', 'High']),
                        'lead_status'       => fake()->randomElement(['open', 'closed', 'junk']),
                        'distribution_date' => fake()->dateTimeBetween('-3 months', 'now')->format('Y-m-d H:i:s'),
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    ];
                }
            }
            Lead::insert($leads);
        });
    }
}

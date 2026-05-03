<?php

namespace Database\Seeders;

use App\Models\History;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $totalSales = Sale::count();
        
        $this->command->info("Seeding histories for {$totalSales} sales...");

        Sale::select('id')->chunk(100, function ($sales) use ($userIds) {
            $histories = [];
            foreach ($sales as $sale) {
                $count = rand(1, 2);
                for ($i = 0; $i < $count; $i++) {
                    $histories[] = [
                        'sale_id'       => $sale->id,
                        'action'        => fake()->randomElement(['Test Drive', 'Showroom Visit', 'WhatsApp Follow-up', 'Sent Quotation', 'Credit Survey', 'Unit Delivery']),
                        'note'          => fake()->randomElement(['Customer interested in credit scheme', 'Requested a test drive for sport model', 'Waiting for leasing approval', 'Comparing prices with other dealer', 'Unit ready for delivery', 'Customer requested specific color']),
                        'status_before' => fake()->randomElement(['new', 'prospect', 'pending']),
                        'status_after'  => fake()->randomElement(['contacted', 'won', 'lost']),
                        'user_id'       => fake()->randomElement($userIds),
                        'action_date'   => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d H:i:s'),
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ];
                }
            }
            History::insert($histories);
        });
    }
}

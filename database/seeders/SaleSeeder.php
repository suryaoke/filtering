<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();

        if (empty($userIds) || empty($productIds)) {
            $this->command->error('No users or products found. Please run UserSeeder and ProductSeeder first.');
            return;
        }

        $total = 10000;
        $chunkSize = 500;
        
        $this->command->info("Seeding {$total} sales...");

        for ($i = 0; $i < $total / $chunkSize; $i++) {
            $sales = [];
            for ($j = 0; $j < $chunkSize; $j++) {
                $sales[] = [
                    'product_id'   => fake()->randomElement($productIds),
                    'company_name' => fake()->company(),
                    'contact_name' => fake()->name(),
                    'email'        => fake()->unique()->safeEmail(),
                    'phone'        => fake()->phoneNumber(),
                    'industry'     => fake()->randomElement(['Personal', 'Corporate Fleet', 'Ride Hailing', 'Online Delivery', 'Motorcycle Club', 'Rental Service']),
                    'source'       => fake()->randomElement(['Showroom Walk-in', 'Facebook Ads', 'Instagram', 'Leasing Partner', 'Repeat Customer', 'WhatsApp Business']),
                    'input_date'   => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
                    'user_id'      => fake()->randomElement($userIds),
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ];
            }
            Sale::insert($sales);
            $this->command->info("Processed " . (($i + 1) * $chunkSize) . " / {$total}");
        }
    }
}

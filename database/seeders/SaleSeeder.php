<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    public function run(): void
    {
        $userIds     = User::pluck('id')->toArray();
        $productIds  = Product::pluck('id')->toArray();
        $customerIds = Customer::pluck('id')->toArray();

        if (empty($userIds) || empty($productIds) || empty($customerIds)) {
            $this->command->error('Missing users, products, or customers. Run their seeders first.');
            return;
        }

        $total     = 1000;
        $chunkSize = 500;

        $industries = [
            'Personal', 'Corporate Fleet', 'Ride Hailing',
            'Online Delivery', 'Motorcycle Club', 'Rental Service',
        ];

        $sources = [
            'Showroom Walk-in', 'Facebook Ads', 'Instagram',
            'Leasing Partner', 'Repeat Customer', 'WhatsApp Business',
        ];

        $this->command->info("Seeding {$total} sales...");

        for ($i = 0; $i < $total / $chunkSize; $i++) {
            $sales = [];
            for ($j = 0; $j < $chunkSize; $j++) {
                $customerId  = fake()->randomElement($customerIds);
                $sales[] = [
                    'product_id'   => fake()->randomElement($productIds),
                    'customer_id'  => $customerId,
                    'company_name' => fake()->company(),
                    'contact_name' => fake()->name(),
                    'email'        => fake()->unique()->safeEmail(),
                    'phone'        => fake()->numerify('08##########'),
                    'industry'     => fake()->randomElement($industries),
                    'source'       => fake()->randomElement($sources),
                    'input_date'   => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
                    'user_id'      => fake()->randomElement($userIds),
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ];
            }
            Sale::insert($sales);
            $this->command->info('  Processed ' . (($i + 1) * $chunkSize) . " / {$total}");
        }

        $this->command->info('✓ SaleSeeder done.');
    }
}

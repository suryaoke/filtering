<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $industries = ['Technology', 'Healthcare', 'Finance', 'Education', 'Manufacturing', 'Retail', 'Logistics'];
        $sources = ['Website', 'Referral', 'Exhibition', 'LinkedIn', 'Cold Call', 'Social Media'];
        $statuses = ['baru', 'dihubungi', 'prospek', 'negosiasi', 'menang', 'kalah', 'pending', 'won', 'lost', 'prospect'];

        return [
            'company_name' => fake()->company(),
            'contact_name' => fake()->name(),
            'email'        => fake()->unique()->safeEmail(),
            'phone'        => fake()->phoneNumber(),
            'industry'     => fake()->randomElement($industries),
            'source'       => fake()->randomElement($sources),
            'input_date'   => fake()->dateTimeBetween('-1 year', 'now'),
            'user_id'      => User::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\History;
use App\Models\Lead;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        return [
            'history_id' => History::factory(),
            'sale_id' => Sale::factory(),
            'sales_id' => User::factory(),
            'lead_name' => fake()->name(),
            'product_interest' => fake()->word(),
            'priority' => fake()->randomElement(['Low', 'Medium', 'High']),
            'lead_status' => fake()->randomElement(['open', 'closed', 'junk']),
            'distribution_date' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }
}

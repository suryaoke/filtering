<?php

namespace Database\Factories;

use App\Models\Followup;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowupFactory extends Factory
{
    protected $model = Followup::class;

    public function definition(): array
    {
        return [
            'lead_id' => Lead::factory(),
            'sales_id' => User::factory(),
            'method' => fake()->randomElement(['Call', 'Email', 'WhatsApp', 'Visit']),
            'note' => fake()->paragraph(),
            'result' => fake()->sentence(),
            'status' => fake()->randomElement(['Interested', 'Not Interested', 'Call Back']),
            'followup_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'next_schedule' => fake()->dateTimeBetween('now', '+1 month'),
        ];
    }
}

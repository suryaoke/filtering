<?php

namespace Database\Factories;

use App\Models\History;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryFactory extends Factory
{
    protected $model = History::class;

    public function definition(): array
    {
        return [
            'sale_id' => Sale::factory(),
            'action' => fake()->randomElement(['Created', 'Called', 'Emailed', 'Meeting', 'Note Added']),
            'note' => fake()->sentence(),
            'status_before' => fake()->randomElement(['new', 'prospect', 'pending']),
            'status_after' => fake()->randomElement(['contacted', 'won', 'lost']),
            'user_id' => User::factory(),
            'action_date' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Followup;
use App\Models\History;
use App\Models\Lead;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PenjualanSeeder::class,
            HistorySeeder::class,
            LeadSeeder::class,
            FollowupSeeder::class,
        ]);
    }
}

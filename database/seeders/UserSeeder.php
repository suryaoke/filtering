<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the users table.
     */
    public function run(): void
    {
        // Buat admin utama
        User::factory()->create([
            'nama' => 'Admin CRM',
            'email' => 'admin@crm.test',
            'role' => 'admin',
            'aktif' => true,
        ]);

        // Buat manager
        User::factory()->count(3)->manager()->create();

        // Buat sales team (20 sales)
        User::factory()->count(20)->sales()->create();

        // Buat user tambahan campuran
        User::factory()->count(6)->create();

        $this->command->info('✅ 30 users created (1 admin, 3 manager, 20 sales, 6 campuran)');
    }
}

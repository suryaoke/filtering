<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@crm.com',
            'password'  => Hash::make('password'),
            'role'      => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'name'      => 'Sales Agent',
            'email'     => 'sales@crm.com',
            'password'  => Hash::make('password'),
            'role'      => 'sales',
            'is_active' => true,
        ]);
    }
}

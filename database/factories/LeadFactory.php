<?php

namespace Database\Factories;

use App\Models\History;
use App\Models\Lead;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
{
    protected $model = Lead::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $produkMinat = [
            'ERP System', 'CRM Software', 'Accounting Software',
            'HRM System', 'POS System', 'Inventory Management',
            'E-Commerce Platform', 'Mobile App Development',
            'Cloud Hosting', 'Cyber Security', 'Data Analytics',
            'Digital Marketing', 'Website Development', 'IoT Solution',
            'AI Chatbot', 'Business Intelligence',
        ];

        $prioritasList = ['rendah', 'sedang', 'tinggi', 'urgent'];

        $statusLeadList = [
            'baru', 'dikualifikasi', 'dalam_proses',
            'proposal_terkirim', 'negosiasi', 'won', 'lost',
        ];

        return [
            'history_id' => History::factory(),
            'penjualan_id' => Penjualan::factory(),
            'sales_id' => User::factory()->sales(),
            'nama_lead' => fake('id_ID')->name(),
            'produk_minat' => fake()->randomElement($produkMinat),
            'prioritas' => fake()->randomElement($prioritasList),
            'status_lead' => fake()->randomElement($statusLeadList),
            'tanggal_distribusi' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}

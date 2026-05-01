<?php

namespace Database\Factories;

use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Penjualan>
 */
class PenjualanFactory extends Factory
{
    protected $model = Penjualan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $namaPerusahaan = [
            'PT Maju Jaya Sentosa', 'CV Berkah Mandiri', 'PT Sinar Abadi',
            'PT Teknologi Nusantara', 'CV Karya Utama', 'PT Global Informatika',
            'PT Surya Pratama', 'CV Cipta Kreasi', 'PT Bumi Perkasa',
            'PT Indo Makmur', 'CV Sejahtera Bersama', 'PT Digital Solusi',
            'PT Mega Pratama', 'CV Andalan Jaya', 'PT Citra Mandiri',
            'PT Harmoni Teknik', 'CV Bintang Timur', 'PT Nusa Karya',
            'PT Alam Sejahtera', 'CV Prima Unggul', 'PT Data Solusi Indonesia',
            'PT Kreasi Digital', 'CV Mitra Sejati', 'PT Telkom Akses',
            'PT Merdeka Teknologi', 'CV Jaya Abadi', 'PT Sarana Informatika',
            'PT Optima Solusi', 'CV Gemilang Karya', 'PT Wahana Digital',
        ];

        $industri = [
            'Teknologi', 'Manufaktur', 'Kesehatan', 'Pendidikan',
            'Keuangan', 'Retail', 'Properti', 'Logistik',
            'F&B', 'Pertanian', 'Otomotif', 'Telekomunikasi',
            'Energi', 'Media', 'Pariwisata',
        ];

        $sumberData = [
            'Website', 'Referral', 'Pameran', 'Cold Call',
            'Social Media', 'Email Marketing', 'Google Ads',
            'LinkedIn', 'Partnership', 'Walk-in',
        ];

        $statusFilter = [
            'baru', 'dihubungi', 'prospek', 'negosiasi',
            'menang', 'kalah', 'pending',
        ];

        return [
            'nama_perusahaan' => fake()->randomElement($namaPerusahaan) . ' ' . fake()->numerify('##'),
            'nama_kontak' => fake('id_ID')->name(),
            'email' => fake()->unique()->companyEmail(),
            'telepon' => fake('id_ID')->phoneNumber(),
            'industri' => fake()->randomElement($industri),
            'sumber_data' => fake()->randomElement($sumberData),
            'status_filter' => fake()->randomElement($statusFilter),
            'tanggal_input' => fake()->dateTimeBetween('-2 years', 'now'),
            'user_id' => User::factory(),
        ];
    }
}

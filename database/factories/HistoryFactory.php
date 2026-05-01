<?php

namespace Database\Factories;

use App\Models\History;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<History>
 */
class HistoryFactory extends Factory
{
    protected $model = History::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $aksiList = [
            'Update Status', 'Tambah Catatan', 'Hubungi Kontak',
            'Kirim Proposal', 'Follow Up', 'Meeting',
            'Presentasi', 'Negosiasi Harga', 'Kirim Invoice',
            'Closing Deal', 'Reschedule', 'Eskalasi',
        ];

        $statusList = [
            'baru', 'dihubungi', 'prospek', 'negosiasi',
            'menang', 'kalah', 'pending',
        ];

        $catatanList = [
            'Klien tertarik dengan produk utama',
            'Perlu follow up minggu depan',
            'Menunggu persetujuan dari manajemen klien',
            'Sudah kirim proposal harga',
            'Klien minta diskon tambahan',
            'Meeting berjalan lancar, klien antusias',
            'Klien belum bisa dihubungi',
            'Perlu demo produk lebih lanjut',
            'Klien meminta revisi penawaran',
            'Deal berhasil ditutup',
            'Klien menunda keputusan ke bulan depan',
            'Sudah presentasi ke tim IT klien',
            'Klien membandingkan dengan kompetitor',
            'Perlu approval dari direktur',
            'Kontrak sedang dalam review legal',
        ];

        $statusSebelum = fake()->randomElement($statusList);
        $statusSesudah = fake()->randomElement(array_diff($statusList, [$statusSebelum]));

        return [
            'penjualan_id' => Penjualan::factory(),
            'aksi' => fake()->randomElement($aksiList),
            'catatan' => fake()->randomElement($catatanList),
            'status_sebelum' => $statusSebelum,
            'status_sesudah' => $statusSesudah,
            'user_id' => User::factory(),
            'tanggal_aksi' => fake()->dateTimeBetween('-2 years', 'now'),
        ];
    }
}

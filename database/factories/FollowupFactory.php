<?php

namespace Database\Factories;

use App\Models\Followup;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Followup>
 */
class FollowupFactory extends Factory
{
    protected $model = Followup::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $metodeList = [
            'Telepon', 'Email', 'WhatsApp', 'Meeting Langsung',
            'Video Call', 'Visit', 'Chat', 'SMS',
        ];

        $catatanList = [
            'Klien meminta informasi lebih lanjut',
            'Sudah dijadwalkan meeting berikutnya',
            'Klien sedang mempertimbangkan',
            'Perlu kirim materi presentasi',
            'Klien minta penawaran revisi',
            'Tidak ada jawaban, coba lagi nanti',
            'Klien sangat tertarik, lanjut ke tahap berikutnya',
            'Menunggu feedback dari tim klien',
            'Klien sudah setuju, proses kontrak',
            'Perlu follow up dengan decision maker',
            'Demo produk berhasil, klien impressed',
            'Klien meminta trial 1 bulan',
            'Budget klien belum tersedia',
            'Klien minta referensi dari klien lain',
        ];

        $hasilList = [
            'Berhasil', 'Pending', 'Tidak Berhasil',
            'Reschedule', 'Lanjut Negosiasi', 'Deal Closed',
            'Butuh Follow Up Lagi',
        ];

        $statusFollowupList = [
            'terjadwal', 'selesai', 'dibatalkan', 'tertunda',
        ];

        $tanggalFollowup = fake()->dateTimeBetween('-6 months', 'now');

        return [
            'lead_id' => Lead::factory(),
            'sales_id' => User::factory()->sales(),
            'metode' => fake()->randomElement($metodeList),
            'catatan' => fake()->randomElement($catatanList),
            'hasil' => fake()->randomElement($hasilList),
            'status_followup' => fake()->randomElement($statusFollowupList),
            'tanggal_followup' => $tanggalFollowup,
            'jadwal_berikutnya' => fake()->dateTimeBetween($tanggalFollowup, '+3 months'),
        ];
    }
}

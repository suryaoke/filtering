<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Followup extends Model
{
    use HasFactory;

    protected $table = 'followups';

    protected $fillable = [
        'lead_id',
        'sales_id',
        'metode',
        'catatan',
        'hasil',
        'status_followup',
        'tanggal_followup',
        'jadwal_berikutnya',
    ];

    protected $casts = [
        'tanggal_followup' => 'datetime',
        'jadwal_berikutnya' => 'datetime',
    ];

    /**
     * Followup dimiliki oleh satu Lead.
     */
    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    /**
     * Followup dimiliki oleh satu Sales (User).
     */
    public function sales(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sales_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class History extends Model
{
    use HasFactory;

    protected $table = 'histories';

    protected $fillable = [
        'penjualan_id',
        'aksi',
        'catatan',
        'status_sebelum',
        'status_sesudah',
        'user_id',
        'tanggal_aksi',
    ];

    protected $casts = [
        'tanggal_aksi' => 'datetime',
    ];

    /**
     * History dimiliki oleh satu Penjualan.
     */
    public function penjualan(): BelongsTo
    {
        return $this->belongsTo(Penjualan::class);
    }

    /**
     * History dimiliki oleh satu User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * History memiliki banyak lead.
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}

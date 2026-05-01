<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    use HasFactory;

    protected $table = 'leads';

    protected $fillable = [
        'history_id',
        'penjualan_id',
        'sales_id',
        'nama_lead',
        'produk_minat',
        'prioritas',
        'status_lead',
        'tanggal_distribusi',
    ];

    protected $casts = [
        'tanggal_distribusi' => 'datetime',
    ];

    /**
     * Lead dimiliki oleh satu History.
     */
    public function history(): BelongsTo
    {
        return $this->belongsTo(History::class);
    }

    /**
     * Lead dimiliki oleh satu Penjualan.
     */
    public function penjualan(): BelongsTo
    {
        return $this->belongsTo(Penjualan::class);
    }

    /**
     * Lead dimiliki oleh satu Sales (User).
     */
    public function sales(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sales_id');
    }

    /**
     * Lead memiliki banyak followup.
     */
    public function followups(): HasMany
    {
        return $this->hasMany(Followup::class);
    }
}

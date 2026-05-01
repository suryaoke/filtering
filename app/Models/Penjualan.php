<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans';

    protected $fillable = [
        'nama_perusahaan',
        'nama_kontak',
        'email',
        'telepon',
        'industri',
        'sumber_data',
        'status_filter',
        'tanggal_input',
        'user_id',
    ];

    protected $casts = [
        'tanggal_input' => 'datetime',
    ];

    /**
     * Penjualan dimiliki oleh satu User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Penjualan memiliki banyak history.
     */
    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }

    /**
     * Penjualan memiliki banyak lead.
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}

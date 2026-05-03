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
        'sale_id',
        'sales_id',
        'lead_name',
        'product_interest',
        'priority',
        'lead_status',
        'distribution_date',
    ];

    protected $casts = [
        'distribution_date' => 'datetime',
    ];

    public function history(): BelongsTo
    {
        return $this->belongsTo(History::class);
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function sales(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sales_id');
    }

    public function followups(): HasMany
    {
        return $this->hasMany(Followup::class);
    }
}

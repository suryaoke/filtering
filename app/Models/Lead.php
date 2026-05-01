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

    /**
     * Lead belongs to one History.
     */
    public function history(): BelongsTo
    {
        return $this->belongsTo(History::class);
    }

    /**
     * Lead belongs to one Sale.
     */
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * Lead belongs to one Sales (User).
     */
    public function sales(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sales_id');
    }

    /**
     * Lead has many followups.
     */
    public function followups(): HasMany
    {
        return $this->hasMany(Followup::class);
    }
}

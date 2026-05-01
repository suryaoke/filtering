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
        'sale_id',
        'action',
        'note',
        'status_before',
        'status_after',
        'user_id',
        'action_date',
    ];

    protected $casts = [
        'action_date' => 'datetime',
    ];

    /**
     * History belongs to one Sale.
     */
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * History belongs to one User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * History has many leads.
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}

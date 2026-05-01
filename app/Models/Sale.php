<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'product_id',
        'company_name',
        'contact_name',
        'email',
        'phone',
        'industry',
        'source',
        'input_date',
        'user_id',
    ];

    protected $casts = [
        'input_date' => 'datetime',
    ];

    /**
     * Sale belongs to one User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that the sale belongs to.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Sale has many histories.
     */
    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }

    /**
     * Sale has many leads.
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}

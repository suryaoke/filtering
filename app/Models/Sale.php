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

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($sale) {
            $sale->input_date = $sale->input_date ?? now();
        });
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}

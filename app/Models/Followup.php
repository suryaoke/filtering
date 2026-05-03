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
        'method',
        'note',
        'result',
        'status',
        'followup_date',
        'next_schedule',
    ];

    protected $casts = [
        'followup_date' => 'datetime',
        'next_schedule' => 'datetime',
    ];


    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function sales(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sales_id');
    }
}

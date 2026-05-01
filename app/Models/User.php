<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['nama', 'email', 'password', 'role', 'aktif'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'aktif' => 'boolean',
        ];
    }

    /**
     * User memiliki banyak penjualan.
     */
    public function penjualans(): HasMany
    {
        return $this->hasMany(Penjualan::class);
    }

    /**
     * User memiliki banyak history.
     */
    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }

    /**
     * User (sebagai sales) memiliki banyak lead.
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class, 'sales_id');
    }

    /**
     * User (sebagai sales) memiliki banyak followup.
     */
    public function followups(): HasMany
    {
        return $this->hasMany(Followup::class, 'sales_id');
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
        ];
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->user_type === 'admin';
    }

    /**
     * Check if the user is a regular user.
     */
    public function isUser(): bool
    {
        return $this->user_type === 'user';
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Set default user_type to 'user' if not provided
        static::creating(function ($user) {
            if (!isset($user->attributes['user_type'])) {
                $user->attributes['user_type'] = 'user';
            }
        });
    }

    /**
     * Override fill method to prevent admin creation via mass assignment
     */
    public function fill(array $attributes)
    {
        if (isset($attributes['user_type']) && $attributes['user_type'] === 'admin') {
            throw new \Exception('Admin users cannot be created via API endpoints');
        }
        
        return parent::fill($attributes);
    }

    /**
     * Get the ATVs owned by the user.
     */
    public function atvs(): HasMany
    {
        return $this->hasMany(Atv::class);
    }
}

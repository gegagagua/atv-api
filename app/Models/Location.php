<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'country',
        'region',
        'type',
        'is_georgian',
        'is_active',
        'latitude',
        'longitude',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_georgian' => 'boolean',
        'is_active' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /**
     * Scope a query to only include active locations.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include Georgian locations.
     */
    public function scopeGeorgian($query)
    {
        return $query->where('is_georgian', true);
    }

    /**
     * Scope a query to only include international locations.
     */
    public function scopeInternational($query)
    {
        return $query->where('is_georgian', false);
    }

    /**
     * Scope a query to filter by country.
     */
    public function scopeByCountry($query, $country)
    {
        return $query->where('country', $country);
    }

    /**
     * Scope a query to filter by type.
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get the full location name with country.
     */
    public function getFullNameAttribute()
    {
        return $this->name . ', ' . $this->country;
    }

    /**
     * Scope a query to search locations by name, country, or region.
     */
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function ($q) use ($searchTerm) {
            $q->where('name', 'LIKE', "%{$searchTerm}%")
              ->orWhere('country', 'LIKE', "%{$searchTerm}%")
              ->orWhere('region', 'LIKE', "%{$searchTerm}%");
        });
    }

    /**
     * Scope a query to get popular locations (cities only).
     */
    public function scopePopular($query)
    {
        return $query->where('type', 'city')->active();
    }

    /**
     * Get the display name for location selection.
     */
    public function getDisplayNameAttribute()
    {
        if ($this->type === 'country') {
            return $this->name;
        }
        
        if ($this->type === 'region') {
            return $this->name . ', ' . $this->country;
        }
        
        return $this->name . ', ' . $this->country;
    }

    /**
     * Get the ATVs for the location.
     */
    public function atvs(): HasMany
    {
        return $this->hasMany(Atv::class);
    }
}

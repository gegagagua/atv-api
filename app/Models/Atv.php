<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Atv extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'year',
        'clearance',
        'mileage',
        'transmission',
        'fuel',
        'isActive',
        'isVip',
        'engine',
        'description',
        'location_id',
        'user_id',
        'brand_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'year' => 'integer',
        'mileage' => 'integer',
        'isActive' => 'boolean',
        'isVip' => 'boolean',
        'location_id' => 'integer',
        'user_id' => 'integer',
        'brand_id' => 'integer',
    ];

    /**
     * Scope a query to only include active ATVs.
     */
    public function scopeActive($query)
    {
        return $query->where('isActive', true);
    }

    /**
     * Scope a query to only include VIP ATVs.
     */
    public function scopeVip($query)
    {
        return $query->where('isVip', true);
    }

    /**
     * Get the images for the ATV.
     */
    public function images(): HasMany
    {
        return $this->hasMany(AtvImage::class);
    }

    /**
     * Get the primary image for the ATV.
     */
    public function primaryImage()
    {
        return $this->hasOne(AtvImage::class)->where('is_primary', true);
    }

    /**
     * Get active images for the ATV.
     */
    public function activeImages(): HasMany
    {
        return $this->hasMany(AtvImage::class)->where('is_active', true)->ordered();
    }

    /**
     * Get all images for the ATV (including inactive).
     */
    public function allImages(): HasMany
    {
        return $this->hasMany(AtvImage::class)->ordered();
    }

    /**
     * Get only image files (not videos) for the ATV.
     */
    public function imageFiles(): HasMany
    {
        return $this->hasMany(AtvImage::class)->where('type', 'image')->ordered();
    }

    /**
     * Get only video files for the ATV.
     */
    public function videoFiles(): HasMany
    {
        return $this->hasMany(AtvImage::class)->where('type', 'video')->ordered();
    }

    /**
     * Get active image files only.
     */
    public function activeImageFiles(): HasMany
    {
        return $this->hasMany(AtvImage::class)
            ->where('type', 'image')
            ->where('is_active', true)
            ->ordered();
    }

    /**
     * Get the first image URL for the ATV (primary or first available).
     */
    public function getFirstImageUrlAttribute(): ?string
    {
        $primaryImage = $this->primaryImage()->first();
        if ($primaryImage) {
            return $primaryImage->url;
        }

        $firstImage = $this->activeImageFiles()->first();
        return $firstImage ? $firstImage->url : null;
    }

    /**
     * Get all image URLs for the ATV.
     */
    public function getImageUrlsAttribute(): array
    {
        return $this->activeImageFiles()->pluck('url')->toArray();
    }

    /**
     * Get gallery data with all necessary information.
     */
    public function getGalleryAttribute(): array
    {
        return $this->activeImages()->get()->map(function ($image) {
            return [
                'id' => $image->id,
                'url' => $image->url,
                'type' => $image->type,
                'alt_text' => $image->alt_text,
                'sort_order' => $image->sort_order,
                'is_primary' => $image->is_primary,
                'is_active' => $image->is_active,
                'created_at' => $image->created_at,
            ];
        })->toArray();
    }

    /**
     * Get the location for the ATV.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the user that owns the ATV.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the brand of the ATV.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}

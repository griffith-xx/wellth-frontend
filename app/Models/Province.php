<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    protected $fillable = [
        'name_th',
        'name_en',
        'region',
        'code',
        'latitude',
        'longitude',
        'capital_district',
        'area_km2',
        'population',
        'postal_code_range',
        'description',
        'famous_for',
        'tourist_attractions',
        'local_specialties',
        'climate_type',
        'is_popular_health_destination',
    ];

    protected $casts = [
        'tourist_attractions' => 'array',
        'local_specialties' => 'array',
        'is_popular_health_destination' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'area_km2' => 'integer',
        'population' => 'integer',
    ];

    /**
     * Get all destinations in this province
     */
    public function destinations(): HasMany
    {
        return $this->hasMany(Destination::class);
    }

    /**
     * Get active destinations in this province
     */
    public function activeDestinations(): HasMany
    {
        return $this->hasMany(Destination::class)->where('is_active', true);
    }

    /**
     * Scope for filtering by region
     */
    public function scopeByRegion($query, string $region)
    {
        return $query->where('region', $region);
    }

    /**
     * Scope for popular health destinations
     */
    public function scopePopularHealthDestinations($query)
    {
        return $query->where('is_popular_health_destination', true);
    }

    /**
     * Scope for filtering by climate type
     */
    public function scopeByClimate($query, string $climateType)
    {
        return $query->where('climate_type', $climateType);
    }

    /**
     * Get the display name (Thai by default)
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name_th;
    }

    /**
     * Get the full region name in Thai
     */
    public function getRegionNameThAttribute(): string
    {
        return match ($this->region) {
            'north' => 'ภาคเหนือ',
            'northeast' => 'ภาคอีสาน',
            'central' => 'ภาคกลาง',
            'east' => 'ภาคตะวันออก',
            'south_west' => 'ภาคใต้ฝั่งตะวันตก',
            'south_east' => 'ภาคใต้ฝั่งตะวันออก',
            default => $this->region,
        };
    }

    /**
     * Get climate type in Thai
     */
    public function getClimateTypeThAttribute(): ?string
    {
        return match ($this->climate_type) {
            'cool' => 'อากาศเย็น',
            'warm' => 'อากาศอบอุ่น',
            'tropical_hot' => 'อากาศร้อนชื้น',
            'sea_breeze' => 'อากาศลมทะเล',
            default => null,
        };
    }
}

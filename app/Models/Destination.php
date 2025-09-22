<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'province_id',
        'description',
        'image_url',
        'gallery_images',
        'suitable_health_goals',
        'suitable_health_conditions',
        'activity_level',
        'spa_treatments_available',
        'traditional_healing_available',
        'fitness_programs_available',
        'accommodation_types',
        'price_range',
        'suitable_trip_duration',
        'suitable_travel_style',
        'nature_types',
        'climate_type',
        'best_months',
        'dietary_options_available',
        'food_restrictions_supported',
        'accessibility_features',
        'languages_supported',
        'medical_support_available',
        'social_environment',
        'expert_rating',
        'popularity_score',
        'location_details',
        'latitude',
        'longitude',
        'contact_phone',
        'website',
        'operating_hours',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            // JSON fields
            'gallery_images' => 'array',
            'suitable_health_goals' => 'array',
            'suitable_health_conditions' => 'array',
            'spa_treatments_available' => 'array',
            'traditional_healing_available' => 'array',
            'fitness_programs_available' => 'array',
            'accommodation_types' => 'array',
            'nature_types' => 'array',
            'best_months' => 'array',
            'dietary_options_available' => 'array',
            'food_restrictions_supported' => 'array',
            'accessibility_features' => 'array',
            'languages_supported' => 'array',
            'social_environment' => 'array',
            'operating_hours' => 'array',
            
            // Decimal fields
            'expert_rating' => 'decimal:2',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            
            // Integer fields
            'popularity_score' => 'integer',
            
            // Boolean fields
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the province that owns the destination
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Get all ratings for this destination
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(DestinationRating::class);
    }

    /**
     * Scope for active destinations only
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for filtering by price range
     */
    public function scopeByPriceRange(Builder $query, string $priceRange): Builder
    {
        return $query->where('price_range', $priceRange);
    }

    /**
     * Scope for filtering by activity level
     */
    public function scopeByActivityLevel(Builder $query, string $activityLevel): Builder
    {
        return $query->where('activity_level', $activityLevel);
    }

    /**
     * Scope for filtering by climate type
     */
    public function scopeByClimate(Builder $query, string $climateType): Builder
    {
        return $query->where('climate_type', $climateType);
    }

    /**
     * Scope for filtering by region through province
     */
    public function scopeByRegion(Builder $query, string $region): Builder
    {
        return $query->whereHas('province', function ($q) use ($region) {
            $q->where('region', $region);
        });
    }

    /**
     * Scope for filtering by health goals
     */
    public function scopeByHealthGoals(Builder $query, array $healthGoals): Builder
    {
        return $query->where(function ($q) use ($healthGoals) {
            foreach ($healthGoals as $goal) {
                $q->orWhereJsonContains('suitable_health_goals', $goal);
            }
        });
    }

    /**
     * Scope for filtering by health conditions
     */
    public function scopeByHealthConditions(Builder $query, array $healthConditions): Builder
    {
        return $query->where(function ($q) use ($healthConditions) {
            foreach ($healthConditions as $condition) {
                $q->orWhereJsonContains('suitable_health_conditions', $condition);
            }
        });
    }

    /**
     * Scope for filtering by spa treatments
     */
    public function scopeBySpaServices(Builder $query, array $spaServices): Builder
    {
        return $query->where(function ($q) use ($spaServices) {
            foreach ($spaServices as $service) {
                $q->orWhereJsonContains('spa_treatments_available', $service);
            }
        });
    }

    /**
     * Scope for filtering by accommodation types
     */
    public function scopeByAccommodationType(Builder $query, array $accommodationTypes): Builder
    {
        return $query->where(function ($q) use ($accommodationTypes) {
            foreach ($accommodationTypes as $type) {
                $q->orWhereJsonContains('accommodation_types', $type);
            }
        });
    }

    /**
     * Scope for filtering by nature preferences
     */
    public function scopeByNatureTypes(Builder $query, array $natureTypes): Builder
    {
        return $query->where(function ($q) use ($natureTypes) {
            foreach ($natureTypes as $type) {
                $q->orWhereJsonContains('nature_types', $type);
            }
        });
    }

    /**
     * Get price range in Thai
     */
    public function getPriceRangeThAttribute(): string
    {
        return match ($this->price_range) {
            'budget' => 'ประหยัด',
            'mid_range' => 'ปานกลาง',
            'luxury' => 'หรูหรา',
            'premium' => 'พรีเมียม',
            default => $this->price_range,
        };
    }

    /**
     * Get activity level in Thai
     */
    public function getActivityLevelThAttribute(): ?string
    {
        return match ($this->activity_level) {
            'low' => 'น้อย',
            'low_moderate' => 'น้อย-ปานกลาง',
            'moderate' => 'ปานกลาง',
            'high' => 'สูง',
            'very_high' => 'สูงมาก',
            default => null,
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

    /**
     * Get average user rating
     */
    public function getAverageUserRatingAttribute(): float
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    /**
     * Get total ratings count
     */
    public function getTotalRatingsAttribute(): int
    {
        return $this->ratings()->count();
    }

    /**
     * Check if destination supports medical needs
     */
    public function supportsMedicalNeeds(): bool
    {
        return $this->medical_support_available;
    }

    /**
     * Check if destination is accessible
     */
    public function isAccessible(): bool
    {
        return !empty($this->accessibility_features);
    }

    /**
     * Get matching score based on user preferences with breakdown
     */
    public function getMatchingScore($userPreferences): array
    {
        $score = 0;
        $totalCriteria = 0;
        $breakdown = [];

        // Health goals matching
        if (!empty($userPreferences['health_goals']) && !empty($this->suitable_health_goals)) {
            $matches = array_intersect($userPreferences['health_goals'], $this->suitable_health_goals);
            $healthGoalsScore = (count($matches) / count($userPreferences['health_goals'])) * 20;
            $score += $healthGoalsScore;
            $totalCriteria += 20;
            $breakdown['health_goals'] = [
                'score' => round($healthGoalsScore, 2),
                'max_score' => 20,
                'matches' => $matches,
                'user_preferences' => $userPreferences['health_goals'],
                'destination_options' => $this->suitable_health_goals
            ];
        }

        // Health conditions matching
        if (!empty($userPreferences['health_conditions']) && !empty($this->suitable_health_conditions)) {
            $matches = array_intersect($userPreferences['health_conditions'], $this->suitable_health_conditions);
            $healthConditionsScore = (count($matches) / count($userPreferences['health_conditions'])) * 15;
            $score += $healthConditionsScore;
            $totalCriteria += 15;
            $breakdown['health_conditions'] = [
                'score' => round($healthConditionsScore, 2),
                'max_score' => 15,
                'matches' => $matches,
                'user_preferences' => $userPreferences['health_conditions'],
                'destination_options' => $this->suitable_health_conditions
            ];
        }

        // Activity level matching
        if (!empty($userPreferences['physical_activity_level']) && $this->activity_level) {
            $activityScore = $userPreferences['physical_activity_level'] === $this->activity_level ? 15 : 0;
            $score += $activityScore;
            $totalCriteria += 15;
            $breakdown['activity_level'] = [
                'score' => $activityScore,
                'max_score' => 15,
                'user_preference' => $userPreferences['physical_activity_level'],
                'destination_option' => $this->activity_level,
                'match' => $userPreferences['physical_activity_level'] === $this->activity_level
            ];
        }

        // Price range matching
        if (!empty($userPreferences['budget_range']) && $this->price_range) {
            $priceScore = $userPreferences['budget_range'] === $this->price_range ? 15 : 0;
            $score += $priceScore;
            $totalCriteria += 15;
            $breakdown['budget_range'] = [
                'score' => $priceScore,
                'max_score' => 15,
                'user_preference' => $userPreferences['budget_range'],
                'destination_option' => $this->price_range,
                'match' => $userPreferences['budget_range'] === $this->price_range
            ];
        }

        // Climate preference matching
        if (!empty($userPreferences['preferred_climate']) && $this->climate_type) {
            $climateScore = $userPreferences['preferred_climate'] === $this->climate_type ? 10 : 0;
            $score += $climateScore;
            $totalCriteria += 10;
            $breakdown['climate'] = [
                'score' => $climateScore,
                'max_score' => 10,
                'user_preference' => $userPreferences['preferred_climate'],
                'destination_option' => $this->climate_type,
                'match' => $userPreferences['preferred_climate'] === $this->climate_type
            ];
        }

        // Nature preferences matching
        if (!empty($userPreferences['nature_preferences']) && !empty($this->nature_types)) {
            $matches = array_intersect($userPreferences['nature_preferences'], $this->nature_types);
            $natureScore = !empty($matches) ? (count($matches) / count($userPreferences['nature_preferences'])) * 10 : 0;
            $score += $natureScore;
            $totalCriteria += 10;
            $breakdown['nature_preferences'] = [
                'score' => round($natureScore, 2),
                'max_score' => 10,
                'matches' => $matches,
                'user_preferences' => $userPreferences['nature_preferences'],
                'destination_options' => $this->nature_types
            ];
        }

        // Spa treatments matching
        if (!empty($userPreferences['spa_treatments']) && !empty($this->spa_treatments_available)) {
            $matches = array_intersect($userPreferences['spa_treatments'], $this->spa_treatments_available);
            $spaScore = !empty($matches) ? (count($matches) / count($userPreferences['spa_treatments'])) * 10 : 0;
            $score += $spaScore;
            $totalCriteria += 10;
            $breakdown['spa_treatments'] = [
                'score' => round($spaScore, 2),
                'max_score' => 10,
                'matches' => $matches,
                'user_preferences' => $userPreferences['spa_treatments'],
                'destination_options' => $this->spa_treatments_available
            ];
        }

        // Traditional healing matching
        if (!empty($userPreferences['traditional_healing']) && !empty($this->traditional_healing_available)) {
            $matches = array_intersect($userPreferences['traditional_healing'], $this->traditional_healing_available);
            $traditionalScore = !empty($matches) ? (count($matches) / count($userPreferences['traditional_healing'])) * 8 : 0;
            $score += $traditionalScore;
            $totalCriteria += 8;
            $breakdown['traditional_healing'] = [
                'score' => round($traditionalScore, 2),
                'max_score' => 8,
                'matches' => $matches,
                'user_preferences' => $userPreferences['traditional_healing'],
                'destination_options' => $this->traditional_healing_available
            ];
        }

        // Fitness programs matching
        if (!empty($userPreferences['fitness_programs']) && !empty($this->fitness_programs_available)) {
            $matches = array_intersect($userPreferences['fitness_programs'], $this->fitness_programs_available);
            $fitnessScore = !empty($matches) ? (count($matches) / count($userPreferences['fitness_programs'])) * 8 : 0;
            $score += $fitnessScore;
            $totalCriteria += 8;
            $breakdown['fitness_programs'] = [
                'score' => round($fitnessScore, 2),
                'max_score' => 8,
                'matches' => $matches,
                'user_preferences' => $userPreferences['fitness_programs'],
                'destination_options' => $this->fitness_programs_available
            ];
        }

        // Travel style matching
        if (!empty($userPreferences['travel_style']) && $this->suitable_travel_style) {
            $travelStyleScore = $userPreferences['travel_style'] === $this->suitable_travel_style ? 8 : 0;
            $score += $travelStyleScore;
            $totalCriteria += 8;
            $breakdown['travel_style'] = [
                'score' => $travelStyleScore,
                'max_score' => 8,
                'user_preference' => $userPreferences['travel_style'],
                'destination_option' => $this->suitable_travel_style,
                'match' => $userPreferences['travel_style'] === $this->suitable_travel_style
            ];
        }

        // Trip duration matching
        if (!empty($userPreferences['trip_duration']) && $this->suitable_trip_duration) {
            $durationScore = $userPreferences['trip_duration'] === $this->suitable_trip_duration ? 5 : 0;
            $score += $durationScore;
            $totalCriteria += 5;
            $breakdown['trip_duration'] = [
                'score' => $durationScore,
                'max_score' => 5,
                'user_preference' => $userPreferences['trip_duration'],
                'destination_option' => $this->suitable_trip_duration,
                'match' => $userPreferences['trip_duration'] === $this->suitable_trip_duration
            ];
        }

        // Accommodation type matching
        if (!empty($userPreferences['accommodation_type']) && !empty($this->accommodation_types)) {
            $accommodationScore = in_array($userPreferences['accommodation_type'], $this->accommodation_types) ? 5 : 0;
            $score += $accommodationScore;
            $totalCriteria += 5;
            $breakdown['accommodation_type'] = [
                'score' => $accommodationScore,
                'max_score' => 5,
                'user_preference' => $userPreferences['accommodation_type'],
                'destination_options' => $this->accommodation_types,
                'match' => in_array($userPreferences['accommodation_type'], $this->accommodation_types)
            ];
        }

        $finalScore = $totalCriteria > 0 ? ($score / $totalCriteria) * 100 : 0;

        return [
            'total_score' => round($finalScore, 2),
            'raw_score' => round($score, 2),
            'total_criteria' => $totalCriteria,
            'breakdown' => $breakdown
        ];
    }
}

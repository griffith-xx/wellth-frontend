<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    protected $fillable = [
        'user_id',
        'health_goals',
        'health_conditions',
        'physical_activity_level',
        'spa_treatments',
        'traditional_healing',
        'fitness_programs',
        'preferred_regions',
        'accommodation_type',
        'budget_range',
        'trip_duration',
        'travel_style',
        'nature_preferences',
        'preferred_climate',
        'preferred_months',
        'healthy_eating_interest',
        'dietary_preferences',
        'food_restrictions',
        'mobility_requirements',
        'language_preference',
        'medical_support_needed',
        'previous_health_tourism',
        'previous_experience_highlights',
        'improvement_areas',
        'priority_factors',
        'social_interaction_level',
    ];

    protected $casts = [
        'health_goals' => 'array',
        'health_conditions' => 'array',
        'spa_treatments' => 'array',
        'traditional_healing' => 'array',
        'fitness_programs' => 'array',
        'preferred_regions' => 'array',
        'nature_preferences' => 'array',
        'preferred_months' => 'array',
        'dietary_preferences' => 'array',
        'food_restrictions' => 'array',
        'mobility_requirements' => 'array',
        'priority_factors' => 'array',
        'healthy_eating_interest' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

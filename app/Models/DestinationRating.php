<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class DestinationRating extends Model
{
    protected $fillable = [
        'destination_id',
        'user_id',
        'rating',
        'service_quality',
        'cleanliness',
        'value_for_money',
        'location_convenience',
        'health_benefits',
        'staff_friendliness',
        'review_title',
        'review_text',
        'pros',
        'cons',
        'recommended_for',
        'visit_month',
        'visit_year',
        'trip_type',
        'is_verified',
        'is_featured',
        'is_active',
        'helpful_count',
        'not_helpful_count',
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'service_quality' => 'decimal:1',
        'cleanliness' => 'decimal:1',
        'value_for_money' => 'decimal:1',
        'location_convenience' => 'decimal:1',
        'health_benefits' => 'decimal:1',
        'staff_friendliness' => 'decimal:1',
        'pros' => 'array',
        'cons' => 'array',
        'recommended_for' => 'array',
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'helpful_count' => 'integer',
        'not_helpful_count' => 'integer',
        'visit_year' => 'integer',
    ];

    /**
     * Get the destination that owns the rating
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    /**
     * Get the user that owns the rating
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for active ratings only
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for verified ratings only
     */
    public function scopeVerified(Builder $query): Builder
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope for featured ratings
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for filtering by rating range
     */
    public function scopeByRatingRange(Builder $query, float $min, float $max): Builder
    {
        return $query->whereBetween('rating', [$min, $max]);
    }

    /**
     * Scope for filtering by trip type
     */
    public function scopeByTripType(Builder $query, string $tripType): Builder
    {
        return $query->where('trip_type', $tripType);
    }

    /**
     * Scope for recent ratings
     */
    public function scopeRecent(Builder $query, int $days = 30): Builder
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Scope for ordering by helpfulness
     */
    public function scopeOrderByHelpfulness(Builder $query): Builder
    {
        return $query->orderByRaw('(helpful_count - not_helpful_count) DESC');
    }

    /**
     * Get trip type in Thai
     */
    public function getTripTypeThAttribute(): ?string
    {
        return match ($this->trip_type) {
            'solo' => 'เดินทางคนเดียว',
            'couple' => 'คู่รัก',
            'family' => 'ครอบครัว',
            'friends' => 'เพื่อน',
            'business' => 'ธุรกิจ',
            default => null,
        };
    }

    /**
     * Get visit date formatted
     */
    public function getVisitDateAttribute(): ?string
    {
        if ($this->visit_month && $this->visit_year) {
            $months = [
                '01' => 'มกราคม',
                '02' => 'กุมภาพันธ์',
                '03' => 'มีนาคม',
                '04' => 'เมษายน',
                '05' => 'พฤษภาคม',
                '06' => 'มิถุนายน',
                '07' => 'กรกฎาคม',
                '08' => 'สิงหาคม',
                '09' => 'กันยายน',
                '10' => 'ตุลาคม',
                '11' => 'พฤศจิกายน',
                '12' => 'ธันวาคม'
            ];

            return $months[$this->visit_month] . ' ' . ($this->visit_year + 543);
        }

        return null;
    }

    /**
     * Get overall category ratings average
     */
    public function getCategoryAverageAttribute(): float
    {
        $ratings = collect([
            $this->service_quality,
            $this->cleanliness,
            $this->value_for_money,
            $this->location_convenience,
            $this->health_benefits,
            $this->staff_friendliness,
        ])->filter()->values();

        return $ratings->isEmpty() ? 0 : $ratings->average();
    }

    /**
     * Get helpfulness ratio
     */
    public function getHelpfulnessRatioAttribute(): float
    {
        $total = $this->helpful_count + $this->not_helpful_count;
        return $total > 0 ? ($this->helpful_count / $total) * 100 : 0;
    }

    /**
     * Check if rating is recent (within 6 months)
     */
    public function isRecent(): bool
    {
        return $this->created_at >= now()->subMonths(6);
    }

    /**
     * Check if rating has detailed review
     */
    public function hasDetailedReview(): bool
    {
        return !empty($this->review_text) && strlen($this->review_text) >= 50;
    }

    /**
     * Get star rating display
     */
    public function getStarDisplayAttribute(): string
    {
        $fullStars = floor($this->rating);
        $halfStar = ($this->rating - $fullStars) >= 0.5 ? 1 : 0;
        $emptyStars = 5 - $fullStars - $halfStar;

        return str_repeat('★', $fullStars) .
            str_repeat('☆', $halfStar) .
            str_repeat('☆', $emptyStars);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientReview extends Model
{
    protected $fillable = [
        'reviewer_name',
        'reviewer_title',
        'review_content',
        'rating',
        'avatar_path',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'rating' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    public function scopeByRating($query, $rating = null)
    {
        if ($rating) {
            return $query->where('rating', $rating);
        }
        return $query;
    }
}

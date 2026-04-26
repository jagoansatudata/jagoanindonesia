<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function getAvatarUrlAttribute(): ?string
    {
        if (!$this->avatar_path) {
            return null;
        }

        $value = ltrim($this->avatar_path, '/');
        if (str_starts_with($value, 'storage/')) {
            $value = substr($value, strlen('storage/'));
        }

        if (Storage::disk('public')->exists($value)) {
            return Storage::disk('public')->url($value);
        }

        if (file_exists(public_path($value))) {
            return asset($value);
        }

        return null;
    }

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

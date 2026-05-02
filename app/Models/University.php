<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class University extends Model
{
    protected $fillable = [
        'name',
        'logo_path',
        'website_url',
        'description',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function getLogoUrlAttribute(): ?string
    {
        if (!$this->logo_path) {
            return null;
        }

        $value = ltrim($this->logo_path, '/');

        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        if (str_starts_with($value, 'storage/')) {
            $value = substr($value, strlen('storage/'));
        }

        if (!str_contains($value, '/')) {
            $candidate = 'universities/' . $value;
            if (Storage::disk('public')->exists($candidate)) {
                return asset('storage/' . $candidate);
            }
        }

        if (Storage::disk('public')->exists($value)) {
            return asset('storage/' . $value);
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
}

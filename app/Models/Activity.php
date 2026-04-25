<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'image_path',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image_path) {
            return null;
        }

        if (!Storage::disk('public')->exists($this->image_path)) {
            return null;
        }

        return asset('storage/' . $this->image_path);
    }
}

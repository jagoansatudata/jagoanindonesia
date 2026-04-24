<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternExperience extends Model
{
    protected $fillable = [
        'intern_name',
        'intern_role',
        'experience_content',
        'rating',
        'avatar_path',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'rating' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
}

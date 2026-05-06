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

        $disk = Storage::disk('public');
        $driver = (string) config('filesystems.disks.public.driver');

        if ($driver === 'local' && !$disk->exists($this->image_path)) {
            return null;
        }

        return $disk->url($this->image_path);
    }
}

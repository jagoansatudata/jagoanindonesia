<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'author',
        'category',
        'category_id',
        'type',
        'status',
        'featured',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'featured' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        if ($category === 'View All') {
            return $query;
        }
        
        return $query->whereHas('category', function ($q) use ($category) {
            $q->where('slug', $category);
        });
    }

    public function scopeByType($query, $type)
    {
        if ($type === 'all') {
            return $query;
        }
        
        return $query->where('type', $type);
    }

    public function scopeNews($query)
    {
        return $query->where('type', 'news');
    }

    public function scopeBlogs($query)
    {
        return $query->where('type', 'blog');
    }

    public function getFormattedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('M d, Y') : '';
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        $value = ltrim($this->image, '/');

        if (Str::startsWith($value, 'storage/')) {
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

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function blogViews()
    {
        return $this->hasMany(BlogView::class);
    }

    public function approvedComments()
    {
        return $this->comments()->where('is_approved', true);
    }

    public function getCommentsCountAttribute()
    {
        // This can be implemented later when comments system is added
        if (!Schema::hasTable('comments')) {
            return 0;
        }

        return $this->approvedComments()->count();
    }

    public function getCategoryNameAttribute()
    {
        return $this->category ? $this->category->name : $this->category;
    }
}

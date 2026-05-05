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
            return asset('storage/' . $value);
        }

        if (file_exists(public_path($value))) {
            return asset($value);
        }

        return null;
    }

    public function getRenderedContentAttribute(): string
    {
        $content = (string) ($this->content ?? '');
        if ($content === '') {
            return '';
        }

        return preg_replace_callback(
            '/(<img\b[^>]*\bsrc=)(["\'])([^"\']+)(\2)/i',
            function ($m) {
                $prefix = $m[1];
                $quote = $m[2];
                $src = $m[3];
                $suffix = $m[4];

                if (preg_match('/^(https?:\/\/|\/|data:)/i', $src)) {
                    return $m[0];
                }

                $filename = basename($src);
                $path = 'images/blog/content/' . $filename;

                if (!Storage::disk('public')->exists($path)) {
                    return $m[0];
                }

                $url = url('/storage/' . $path);

                return $prefix . $quote . $url . $suffix;
            },
            $content
        );
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

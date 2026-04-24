<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogView extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'ip_address',
        'user_agent',
        'referer',
        'viewed_at',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    public $timestamps = true;

    /**
     * Get the blog that owns the view.
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    /**
     * Scope to get views within a date range.
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('viewed_at', [$startDate, $endDate]);
    }

    /**
     * Scope to get unique views by IP address.
     */
    public function scopeUniqueViews($query)
    {
        return $query->distinct('ip_address');
    }

    /**
     * Get total views for a blog in a date range.
     */
    public static function getTotalViews($blogId, $startDate = null, $endDate = null)
    {
        $query = static::where('blog_id', $blogId);
        
        if ($startDate && $endDate) {
            $query->dateRange($startDate, $endDate);
        }
        
        return $query->count();
    }

    /**
     * Get unique views for a blog in a date range.
     */
    public static function getUniqueViews($blogId, $startDate = null, $endDate = null)
    {
        $query = static::where('blog_id', $blogId)->uniqueViews();
        
        if ($startDate && $endDate) {
            $query->dateRange($startDate, $endDate);
        }
        
        return $query->count();
    }

    /**
     * Track a new view for a blog.
     */
    public static function trackView($blogId, $request = null)
    {
        $data = [
            'blog_id' => $blogId,
            'viewed_at' => now(),
        ];

        if ($request) {
            $data['ip_address'] = $request->ip();
            $data['user_agent'] = $request->userAgent();
            $data['referer'] = $request->header('referer');
        }

        return static::create($data);
    }
}

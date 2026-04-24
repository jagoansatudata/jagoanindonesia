<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = [
        'type',
        'path',
        'viewable_type',
        'viewable_id',
        'ip_address',
        'user_agent',
        'session_id',
    ];

    protected $casts = [
        'viewable_id' => 'integer',
    ];

    public function viewable()
    {
        return $this->morphTo();
    }
}

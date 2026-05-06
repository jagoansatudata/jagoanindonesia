<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'position',
        'photo',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo) {
            return null;
        }

        if (Str::startsWith($this->photo, ['http://', 'https://', '//'])) {
            return $this->photo;
        }

        if (Storage::disk('public')->exists('team/' . $this->photo)) {
            return Storage::disk('public')->url('team/' . $this->photo);
        }

        if (File::exists(public_path('images/team/' . $this->photo))) {
            return asset('images/team/' . $this->photo);
        }

        return null;
    }
}

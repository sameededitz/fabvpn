<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = ['name', 'android', 'ios', 'macos', 'windows', 'longitude', 'latitude', 'type', 'status'];

    protected $casts = [
        'android' => 'boolean',
        'ios' => 'boolean',
        'macos' => 'boolean',
        'windows' => 'boolean',
    ];

    protected $appends = ['image_url'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->useDisk('media')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/jpg']);
    }

    public function getImageUrlAttribute()
    {
        $media = $this->getFirstMedia('image');
        return $media ? $media->getUrl() : null;
    }

    public function subServers()
    {
        return $this->hasMany(SubServer::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Activity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'cover_image',
        'content',
        'activity_date',
        'location',
        'is_active',
    ];

    protected $casts = [
        'activity_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi: 1 Activity punya banyak gambar dokumentasi
     */
    public function images()
    {
        return $this->hasMany(ActivityImage::class);
    }

    /**
     * Auto-generate slug saat create
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($activity) {
            if (empty($activity->slug)) {
                $activity->slug = Str::slug($activity->title);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

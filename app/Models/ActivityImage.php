<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityImage extends Model
{
    protected $fillable = [
        'activity_id',
        'image',
    ];

    /**
     * Relasi: gambar milik satu activity
     */
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}

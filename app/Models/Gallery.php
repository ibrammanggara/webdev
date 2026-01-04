<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'image',
        'title',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}

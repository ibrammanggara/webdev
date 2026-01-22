<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'cover_image',
        'price',
        'discount_price',
        'stock',
        'category',
        'description',
        'is_active'
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function product_sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    protected $fillable = [
        'name',
        'price',
        'category_id',
        'product_image',
    ];

}

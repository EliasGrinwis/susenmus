<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    public function size()
    {
        return $this->belongsTo(Size::class)->withDefault();
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

    protected $fillable = ['product_id', 'size_id', 'quantity', 'max_quantity_available'];

}

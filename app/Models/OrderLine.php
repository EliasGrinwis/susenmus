<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class)->withDefault();
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

    protected $fillable = [
        'order_id',
        'product_id',
        'size',
        'image_path',
        'amount',
    ];
}

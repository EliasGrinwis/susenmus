<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function status()
    {
        return $this->belongsTo(Status::class)->withDefault();
    }

    public function order_lines()
    {
        return $this->hasMany(OrderLine::class);
    }

    protected $fillable = [
        'user_id',
        'status_id',
        'isOrdered',
        'order_date'
    ];
}

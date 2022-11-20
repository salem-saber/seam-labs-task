<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'item_quantity',
        'item_price',
        'item_name',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}

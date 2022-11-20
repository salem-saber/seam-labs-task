<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'type',
        'customer_number',
        'customer_name',
        'delivery_fees',
        'table_number',
        'service_charge',
        'waiter_name',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}

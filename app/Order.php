<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // get the users orders with the ring, order_items table as wel
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}

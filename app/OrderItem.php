<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class OrderItem extends Model
{ 
    // from the user with orderItems belongs to ring id and order id
    public function ring()
    {
        return $this->belongsTo(Ring::class);
    }

}

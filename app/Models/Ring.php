<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ring extends Model
{   

    use HasFactory;

    public static function getAllRings()
    {
        return self::all();
    }

    // get them with Types joined
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}

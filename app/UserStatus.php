<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserStatus extends Model
{
    public function userStatus()
    {
      return $this->belongsTo(User::class);
    }
}

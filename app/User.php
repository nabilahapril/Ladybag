<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = [];
   
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
  
}

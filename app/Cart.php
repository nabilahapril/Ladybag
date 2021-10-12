<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];
    public function line_item()
    {
        return $this->hasMany(line_item::class);
    }
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    
   
    
}

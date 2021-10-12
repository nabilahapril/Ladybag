<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Status extends Model
{
    protected $guarded = [];
    

    
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
   
}

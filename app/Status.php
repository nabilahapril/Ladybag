<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Status extends Model
{
    protected $guarded = [];
    public $timestamps=false;
    

    
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
   
}

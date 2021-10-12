<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];
    public $timestamps=false;
 
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function line_item_clone()
    {
        return $this->belongsTo(line_item_clone::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}

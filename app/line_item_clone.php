<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class line_item_clone extends Model
{
    protected $guarded = [];
  
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function Image()
    {
        return $this->belongsTo(Image::class);
    }
 
  
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Image extends Model
{
    protected $guarded = [];

    public $timestamps=false;

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value); 
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function line_item()
    {
        return $this->hasMany(line_item::class);
    }
}

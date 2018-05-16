<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    public function space()
    {
        return $this->belongsTo(Space::class);
    }
    
    protected $fillable = ['value', 'title', 'type', 'place_number', 'space_id'];
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'type', 'thumbnail', 'visibility', 'user_id'
    ];

    public function components()
    {
        return $this->hasMany(Component::class);
    }
}

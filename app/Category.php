<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'image',
        'description'
    ];

    public function destinations()
    {
        return $this->hasMany(Destinations::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}

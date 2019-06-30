<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name','slug','color','image',
    ];

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
}

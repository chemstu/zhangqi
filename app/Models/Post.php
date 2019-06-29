<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title','slug','status','image','body','category_id'
    ];

    public function tags()
    {
        return $this->belongsToMany('App\Models\tag','post_tags')->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo('App\Models\category');
    }


}

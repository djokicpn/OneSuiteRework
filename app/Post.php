<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'post_text','category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

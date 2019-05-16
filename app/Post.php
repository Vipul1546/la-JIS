<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'post_author', 'permalink', 'content', 'featuredImg', 'tag', 'category', 'type'];
}

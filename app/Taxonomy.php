<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
        protected $fillable = ['title', 'slug', 'description', 'taxonomy', 'post_type', 'meta'];
}

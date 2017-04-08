<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Tag;

class Lesson extends Model
{
    protected $fillable = ['title', 'body', 'isPublished'];

    public function tags(){
    	return $this->belongsToMany('App\Tag');
    }
}

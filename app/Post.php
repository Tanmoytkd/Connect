<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'section_id',
        'content',
        'user_id',
        'privacy_level'
    ];

    public function likes() {
        return $this->hasMany('App\Like', 'post_id', 'id');
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'post_id', 'id');
    }

    public function section() {
        return $this->belongsTo('App\Section', 'section_id', 'id');
    }


}

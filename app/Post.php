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

    public function writer() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function likes() {
        return $this->hasMany('App\Like', 'post_id', 'id');
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'post_id', 'id');
    }

    public function section() {
        return $this->belongsTo('App\Section', 'section_id', 'id');
    }

    public function commentCount() {
        return $this->comments()->count();
    }

    public function likesCount() {
        return $this->likes()->count();
    }



}

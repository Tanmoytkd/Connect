<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content',
        'post_id',
        'user_id',
        'parent_id'
    ];

    public function commenter() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function parent() {
        return $this->belongsTo('App\Comment', 'parent_id', 'id');
    }

    public function children() {
        return $this->hasMany('App\Comment', 'parent_id', 'id');
    }

    public function post() {
        return $this->belongsTo('App\Post', 'post_id', 'id');
    }
}

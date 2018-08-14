<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'parent_id',
        'section_type',
        'completion_status',
        'section_image_path',
        'name'
    ];

    public function subscribers() {
        return $this->belongsToMany('App\User', 'subscriptions', 'section_id', 'subscriber_id');
    }

    public function posts() {
        return $this->hasMany('App\Post', 'section_id', 'id');
    }

    public function getPublicPosts() {
        return $this->posts()->latest()->where('privacy_level', 'public')->get();
    }
}

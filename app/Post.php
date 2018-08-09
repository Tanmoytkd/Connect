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
}

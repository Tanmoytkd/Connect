<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userInfo extends Model
{
    protected $fillable = ["username"];

    public function user() {
        return $this->belongsTo('App\User');
    }
}

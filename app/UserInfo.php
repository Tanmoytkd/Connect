<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class userInfo extends Model
{
    use softDeletes;
    protected $fillable = ["username"];

    protected $dates = [
        'deleted_at'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}

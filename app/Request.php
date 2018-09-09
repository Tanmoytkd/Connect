<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Request extends Model
{

    public function requester() {
        return $this->belongsTo('App\User', 'requester_id', 'id');
    }

    public function recepient() {
        return $this->belongsTo('App\User', 'recepient_id', 'id');
    }
}

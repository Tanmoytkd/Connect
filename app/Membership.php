<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function section() {
        return $this->belongsTo('App\Section', 'section_id', 'id');
    }

    public function role() {
        return $this->belongsTo('App\Role', 'role_id', 'id');
    }
}

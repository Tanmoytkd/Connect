<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        "contract",
        "user_id",
        "contractor_id",
        "section_id"
    ];

    public function owner() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function signer() {
        return $this->belongsTo('App\User', 'contractor_id', 'id');
    }

    public function section() {
        return $this->belongsTo('App\Section', 'section_id', 'id');
    }
}

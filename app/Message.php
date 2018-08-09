<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content'
    ];

    public static function getMessages($firstUserId, $secondUserId) {
        $user = User::findOrFail($firstUserId);
        return $user->getMessages($secondUserId);
    }

    public function sender() {
        return $this->belongsTo('App\User', 'sender_id', 'id');
    }

    public function receiver() {
        return $this->belongsTo('App\User', 'receiver_id', 'id');
    }
}

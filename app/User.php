<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Translation\MessageSelector;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function info() {
        return $this->hasOne('App\UserInfo', 'user_id', 'id');
    }

    public function memberships() {
        return $this->hasMany('App\Membership', 'user_id', 'id');
    }

    public function isSystemAdmin() {
        $memberships = $this->memberships;
        foreach ($memberships as $membership) {
            if($membership->role->role_name == 'system_admin') return true;
        }
        return false;
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'user_id', 'id');
    }

    public function isCommenter($commentId) {
        return $this == Comment::findOrFail($commentId)->commenter();
    }

    public function ownContracts() {
        return $this->hasMany('App\Contract', 'user_id', 'id');
    }

    public function peerContracts() {
        return $this->hasMany('App\Contract', 'contractor_id', 'id');
    }

    public function likes() {
        return $this->hasMany('App\Like', 'user_id', 'id');
    }

    public function likedPosts() {
        return $this->hasManyThrough('App\Post', 'App\Like', 'user_id', 'id', 'id', 'post_id');

    }

    public function hasLiked($postId) {
        $data = $this->likedPosts->where('id', $postId);
        return $data->count() > 0;
    }

    public function isMember($sectionId) {
        $data = $this->memberships()->where('section_id', $sectionId);
        return $data->exists();
    }

    public function getRole($sectionId) {
        if(!$this->isMember($sectionId)) return "Guest";
        else return $this->memberships()->where('section_id', $sectionId)->first()->role()->first();
    }

    public function getMessages($userId) {
        return Message::where(function ($query) use ($userId ){
            $query->where('sender_id', $this->id)->orwhere('sender_id', $userId);
        })->where(function ($query) use ($userId) {
            $query->where('receiver_id', $this->id)->orwhere('receiver_id', $userId);
        })->get();
    }

    public function allMessages() {
        return Message:: where(function ($query) {
            $query->where('sender_id', $this->id)->orwhere('receiver_id', $this->id);
        });
    }

    public function getSenderList() {
        $collection = collect([]);
        $messages = $this->allMessages()->latest()->get();
        foreach ($messages as $msg) {
            $sender = $msg->sender;
            $receiver = $msg->receiver;

            //return $this->id;
            if($sender->id!=$this->id) {
                $collection->push($sender);
            }
            else {
                $collection->push($receiver);
            }
        }
        return  $collection->unique();
    }

    public function getLastMessage($userId, $n = 1) {
        return $this->allMessages()->where(function ($query) use ($userId) {
            $query->where('sender_id', $userId)->orWhere('receiver_id', $userId);
        })->latest()->skip($n-1)->first();
    }
}

<?php

namespace App;

use Exception;
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

    public function getFirstName() {
        $name = $this->name;
        return explode(' ',trim($name))[0];
    }

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

    public function givenlikes() {
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
        if($userId==$this->id) {
            return Message::where(function ($query) use ($userId ) {
                $query->where('sender_id', $this->id)->where('receiver_id', $this->id);
            })->get();
        } else {
            return Message::where(function ($query) use ($userId ){
                $query->where('sender_id', $this->id)->orwhere('receiver_id', $this->id);
            })->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)->orwhere('receiver_id', $userId);
            })->get();
        }
    }

    public function allMessages() {
        return Message:: where(function ($query) {
            $query->where('sender_id', $this->id)->orwhere('receiver_id', $this->id);
        });
    }

    public function getSenderList($n = 0) {
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
        if($n!=0) return $collection->unique()->take($n);
        return  $collection->unique();
    }



    public function getLastMessage($userId, $n = 1) {
        if($userId==$this->id) {
            return Message::where('sender_id', $this->id)->where('receiver_id', $this->id)->latest()->skip($n-1)->first();
        }
        return $this->allMessages()->where(function ($query) use ($userId) {
            $query->where('sender_id', $userId)->orWhere('receiver_id', $userId);
        })->latest()->skip($n-1)->first();
    }

    public function posts() {
        return $this->hasMany('App\Post', 'user_id', 'id');
    }

    public function sentRequests() {
        return $this->hasMany('App\Request', 'requester_id', 'id');
    }

    public function receivedRequests() {
        return $this->hasMany('App\Request', 'recepient_id', 'id');
    }

    public function joinRequests() {
        return $this->sentRequests()->where('request_type', 'join_request');
    }

    public function inviteRequests() {
        return $this->receivedRequests()->where('request_type', 'invitations');
    }

    public function getProjects() {
        return $this->memberships()->where('parent_id', 0)->get();
    }

    public function skills() {
        return $this->belongsToMany('App\Skill');
    }

    public function subscriptions() {
        return $this->belongsToMany('App\Section', 'subscriptions', 'subscriber_id', 'section_id');
    }

    public function getUserName() {
        return $this->info->username;
    }

    public function createUserSection() {
        $UserSection = new Section();
        $UserSection->parent_id = 0;
        $UserSection->section_type = 'user';
        $UserSection->name = strval($this->id);
        $UserSection->save();

        $userInfo = $this->info;
        $userInfo->section_id = $UserSection->id;
        $userInfo->save();
    }

    public function getUserSection() {
        $UserSection = Section::where('section_type', 'user')->where('name', strval($this->id))->get();
        if($UserSection->isEmpty()) {
            $this->createUserSection();
            $UserSection = Section::where('section_type', 'user')->where('name', strval($this->id))->get();
        }
        return $UserSection->first();
    }

    public function depositMoney($amount) {
        try {
            $myInfo = $this->info;
            $myInfo->balance = $myInfo->balance + $amount;
            $myInfo->save();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function withdrawMoney($amount) {
        try {
            $myInfo = $this->info;
            if($myInfo->balance >= $amount) {
                $myInfo->balance = $myInfo->balance - $amount;
            } else {
                return false;
            }
            $myInfo->save();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function sendMoney($userId, $amount) {
        $receiver = User::findOrFail($userId);
        try {
            $myInfo = $this->info;
            $receiverInfo = $receiver->info;
            if($myInfo->balance >= $amount) {
                $myInfo->balance = $myInfo->balance - $amount;
                $receiverInfo->balance = $receiverInfo->balance + $amount;
            } else {
                return false;
            }
            $myInfo->save();
            $receiverInfo->save();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}

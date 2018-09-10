<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
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
        return ($data->count() > 0);
    }

    public function hasPostPermission($sectionId) {
        $sec = Section::find($sectionId);
        if($sec->isProject() && $this->isAdmin($sectionId)) return true;
        if($sec->isChildSection() && $this->isMember($sectionId)) return true;
        return false;
    }

    public function hasSectionCreationPermission($parentId) {
        if($parentId!=0 && !$this->isAdmin($parentId)) {
            return false;
        }
        return true;
    }

    public function like($postId) {

        return Like::create(['user_id'=>$this->id, 'post_id'=>$postId]);
    }

    public function unLike($postId) {
        $record = Like::where('user_id', $this->id)->where('post_id', $postId);
        return $record->delete();
    }

    public function toggleLike($postId) {
        if($this->hasLiked($postId)) return $this->unLike($postId);
        else return $this->like($postId);
    }


    public function isMember($sectionId) {
        $data = $this->memberships()->where('section_id', $sectionId);
        return $data->exists();
    }

    public function isGuest($sectionId) {
        return ($this->getRole($sectionId)->role_name == 'guest');
    }

    public function isManager($sectionId) {
        return ($this->getRole($sectionId)->role_name == 'manager');
    }

    public function isAdmin($sectionId) {
        return ($this->getRole($sectionId)->role_name == 'admin');
    }

    public function getRole($sectionId) {
        if(!$this->isMember($sectionId)) return Role::getSection("guest");
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
        return $this->receivedRequests()->where('request_type', 'invitation');
    }

    public function hasRequestedToJoin($sectionId) {
        $requests = $this->sentRequests()->where('section_id', $sectionId)->where('request_type', 'join_request')->get();
        return ($requests->count()>0);
    }

    public function hasBeenInvitedToJoin($sectionId) {
        $requests = $this->receivedRequests()->where('section_id', $sectionId)->where('request_type', 'invitation')->get();
        return ($requests->count()>0);
    }

    public function invite($sectionId, $userId, $id=null, $contract=null) {
        if(!$this->hasUserAcceptPermission($sectionId)) return;
        $recepient = User::findOrFail($userId);
        if($id==null && $recepient->hasBeenInvitedToJoin($sectionId, $userId)) return;
        if($id==null) $request = new Request();
        else $request = Request::findOrFail($id);
        $request->request_type = 'invitation';
        $request->section_id = $sectionId;
        $request->recepient_id = $userId;
        $request->contract = $contract;
        $this->sentRequests()->save($request);
    }

    public function requestToJoin($sectionId, $id = null, $contract=null) {
        if($id==null && $this->hasRequestedToJoin($sectionId)) return;
        if($id==null) $request = new Request();
        else $request = Request::findOrFail($id);
        $request->request_type = 'join_request';
        $request->section_id = $sectionId;
        $request->contract = $contract;
        $this->sentRequests()->save($request);
    }

    public function deleteRequest($id) {
        Request::findOrFail($id)->delete();
    }

    public function cancelJoinRequest($sectionId) {
        $requests = $this->sentRequests()->where('section_id', $sectionId)->where('request_type', 'join_request')->delete();
    }

    public function cancelInvitation($sectionId, $userId=null) {
        if($userId==null) $userId = $this->id;
        $requests = Request::where('section_id', $sectionId)->where('request_type', 'invitation')->where('recepient_id', $userId)->delete();
    }

    public function join($sectionId) {
        $membership = new Membership();
        $membership->section_id = $sectionId;
        $membership->role_id = Role::getSection('member')->id;

        $this->memberships()->save($membership);
    }

    public function leave($sectionId) {
        $this->memberships()->where('section_id', $sectionId)->delete();
    }

    public function setRole($sectionId, $roleId) {
        $membership = $this->memberships()->where('section_id', $sectionId)->first();
        $membership->role_id = $roleId;
        $membership->save();
    }

    public function setRoleByName($sectionId, $roleName) {
        $role = Role::getSection($roleName);
        $this->setRole($sectionId, $role->id);
    }

    public function getSections() {
        $memberships = $this->memberships->all();
        $projects = collect([]);
        foreach ($memberships as $member) {
            $currentSection = $member->section()->first();

            $section_type = $currentSection['section_type'];
            $parent_id = $currentSection['parent_id'];
            if($parent_id != 0 && $section_type == 'section') {
                $projects->push($currentSection);
            }
        }
        return $projects;
    }

    public function getProjects() {
        $memberships = $this->memberships->all();
        $projects = collect([]);
        foreach ($memberships as $member) {
            $currentSection = $member->section()->first();

            $section_type = $currentSection['section_type'];
            $parent_id = $currentSection['parent_id'];
            if($parent_id == 0 && $section_type == 'project') {
                $projects->push($currentSection);
            }
        }
        return $projects;
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
        $userSection = new Section();
        $userSection->parent_id = 0;
        $userSection->section_type = 'user';
        $userSection->name = strval($this->id);
        $userSection->save();

        $userInfo = $this->info;
        $userInfo->section_id = $userSection->id;
        $userInfo->save();

        $adminMembership = new Membership();
        $adminMembership->user_id=$this->id;
        $adminMembership->role_id = Role::getSection('admin')->id;
        $userSection->memberships()->save($adminMembership);

        $this->subscribe($userSection->id);
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

    public function isSubscriber($sectionId) {
        $tbl = $this->subscriptions()->get()->where('id', $sectionId);
        return $tbl->count() > 0;
    }

    public function subscribe($sectionId) {
        if(!$this->isSubscriber($sectionId))
            $this->subscriptions()->attach($sectionId);
    }

    public function unsubscribe($sectionId) {
        $this->subscriptions()->detach($sectionId);
    }

    public function getProfilePicPath() {
        return $this->info->profile_pic_path;
    }

    public function getCoverPicPath() {
        return $this->getUserSection()->getCoverPath();
    }

    public function getNewsFeedPosts($pageNo = 1, $postEachPage = 10) {
        $subscribedSections = $this->subscriptions->all();
        $ids = collect([]);

        foreach ($subscribedSections as $sec) {
            $ids->push($sec->id);
        }

        $skips = ($pageNo-1)*$postEachPage;

        $posts = Post::whereIn('section_id', $ids)->latest()->skip($skips)->take($postEachPage)->get()->all();

        return $posts;
    }

    public function hasUserAcceptPermission($sectionId) {
        return ($this->isAdmin($sectionId) || $this->isManager($sectionId));
    }

    public function acceptRequest($request_id) {
        $request = Request::findOrFail($request_id);


        if($request->request_type == 'join_request') {
            $user = User::findOrFail($request->requester_id);
            $contractor = $this;
        } else {
            $contractor = User::findOrFail($request->requester_id);
            $user = $this;
            if($this->id != $request->recepient_id) return;
        }

        if(!$contractor->hasUserAcceptPermission($request->section_id)) return;

        $contract = new Contract();
        $contract->section_id = $request->section_id;
        $contract->user_id = $user->id;
        $contract->contractor_id = $contractor->id;
        $contract->contract = $request->contract;
        $contract->save();
        $user->join($request->section_id);
        $request->delete();

        if($request->request_type == 'join_request') {
            $section = Section::find($request->section_id);
            $notification = new SimpleNotification();
            $notification->recepient_id = $user->id;
            $notification->link = Route('project.show', $request->section_id);
            $notification->image_to_show = $section->getLogoPath();
            $notification->notification_text = $contractor->name.' accepted your request to join '.$section->name;
            $notification->save();
        }
    }

    public function rejectRequest($requestId) {
        $request = Request::findOrFail($requestId);

        if($request->request_type == 'join_request') {
            $user = User::findOrFail($request->requester_id);
            $contractor = $this;
        } else {
            $contractor = User::findOrFail($request->requester_id);
            $user = $this;
            if($this->id != $request->recepient_id) return;
        }

        if(!$contractor->hasUserAcceptPermission($request->section_id)) return;
        $request->delete();

        if($request->request_type == 'join_request') {
            $section = Section::find($request->section_id);
            $notification = new SimpleNotification();
            $notification->recepient_id = $user->id;
            $notification->link = Route('project.show', $request->section_id);
            $notification->image_to_show = $section->getLogoPath();
            $notification->notification_text = 'Your request to join '.$section->name.' was denied';
            $notification->save();
        }
    }

    public function negotiateRequest($requestId, $contract=null) {
        $request = Request::findOrFail($requestId);

        if($request->request_type == 'join_request') {
            $user = User::findOrFail($request->requester_id);
            $contractor = $this;
            if(!$contractor->hasUserAcceptPermission($request->section_id)) return;

            $request->request_type = 'invitation';
            $request->requester_id = $contractor->id;
            $request->recepient_id = $user->id;
            $request->contract = $contract;
            $request->save();
        } else {
            $contractor = User::findOrFail($request->requester_id);
            $user = $this;
            if($this->id != $request->recepient_id) return;

            $request->request_type = 'join_request';
            $request->requester_id = $user->id;
            $request->recepient_id = $contractor->id;
            $request->contract = $contract;
            $request->save();
        }
    }

    public function notifications() {
        return $this->hasMany('App\SimpleNotification', 'recepient_id', 'id');
    }
}

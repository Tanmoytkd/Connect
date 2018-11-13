<?php

namespace App\Http\Controllers;

use App\Section;
use App\SimpleNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    public function follow($sectionId) {
        Auth::user()->subscribe($sectionId);

        $section = Section::find($sectionId);
        $notification = new SimpleNotification();
        $notification->recepient_id = (int) $section->name;
        $notification->link = Route('profile.show', Auth::user()->id);
        $notification->image_to_show = Auth::user()->getProfilePicPath();
        $notification->notification_text = Auth::user()->name.' started following you';
        $notification->save();

        return redirect()->back();
    }

    public function unfollow($sectionId) {
        Auth::user()->unsubscribe($sectionId);
        return redirect()->back();
    }

    public function makeInvitation() {
        $userId = $_POST['userId'];
        $sectionId = $_POST['sectionId'];
        return $this->invite($userId, $sectionId);
    }

    public function invite($userId = null, $sectionId = null) {
        if(isset($userId) && isset($sectionId)) {
            Auth::user()->invite($sectionId, $userId);
            return redirect(Route('project.show', ['id'=>$sectionId]));
        }
        if(!isset($userId)) {
            return view('inviteUser', compact(['userId', 'sectionId']));
        }
        if(!isset($sectionId)) {
            return view('inviteToSection', compact(['userId', 'sectionId']));
        }

        return redirect()->back();
    }

    public function inviteToSection($sectionId=null) {
        return $this->invite(null, $sectionId);
    }
}

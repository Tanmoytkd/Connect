<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    public function follow($sectionId) {
        Auth::user()->subscribe($sectionId);
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
        return view('invitePage', compact(['userId', 'sectionId']));
        return redirect()->back();
    }

    public function inviteToSection($sectionId=null) {
        return $this->invite(null, $sectionId);
    }
}

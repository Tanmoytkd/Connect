<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function manageRequest() {
        if(!isset($_POST['contract'])) $_POST['contract']=null;
        if($_POST['mode']=='requestToJoin') return $this->requestToJoin();
        else if($_POST['mode']=='cancelJoinRequest') return $this->cancelJoinRequest();
        else if($_POST['mode']=='join') return $this->join();
        else if($_POST['mode']=='leave') return $this->leave();
    }

    public function requestToJoin() {
        $contract = $_POST['contract'];
        $sectionId = $_POST['section_id'];
        Auth::user()->requestToJoin($sectionId, null, $contract);
        return  redirect()->back();
    }

    public function cancelJoinRequest() {
        $sectionId = $_POST['section_id'];
        Auth::user()->cancelJoinRequest($sectionId);
        return redirect()->back();
    }

    public function join() {
        $sectionId = $_POST['section_id'];
        Auth::user()->join($sectionId);
        return redirect()->back();
    }

    public function leave() {
        $sectionId = $_POST['section_id'];
        Auth::user()->leave($sectionId);
        return redirect()->back();
    }
}

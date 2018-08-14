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
}

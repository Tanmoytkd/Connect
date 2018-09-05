<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsFeedController extends Controller
{
    public function index($pageNo = 1, $postEachPage = 10) {
        $person = Auth::user();
        $user = Auth::user();
        $id = $user->id;
        $isMyself = ($person->id == Auth::user()->id);

        $posts = $user->getNewsFeedPosts($pageNo, $postEachPage);

        return view('newsFeed', compact( ['id', 'person', 'user', 'isMyself', 'posts']));
    }
}

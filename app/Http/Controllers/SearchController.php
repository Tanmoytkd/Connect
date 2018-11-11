<?php

namespace App\Http\Controllers;

use App\Section;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index() {
        $searchQuery = trim($_GET['search']);
        $person = Auth::user();
        $user = Auth::user();
        $id = $user->id;
        $isMyself = ($person->id == Auth::user()->id);
        $sections = Section::where('section_type', 'section')->where('name', 'LIKE', '%'.$searchQuery.'%')->get()->all();
        $projects = Section::where('section_type', 'project')->where('name', 'LIKE', '%'.$searchQuery.'%')->get()->all();
        $users = User::where('name', 'LIKE', '%'.$searchQuery.'%')->get()->all();

        return view('basicSearchPage', compact('searchQuery', 'person', 'user', 'id', 'isMyself', 'users', 'projects', 'sections'));
    }
}

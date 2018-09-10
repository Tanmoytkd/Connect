<?php

namespace App\Http\Controllers;

use App\Membership;
use App\Role;
use App\Section;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('userProjects');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($parentId = 0)
    {
        $hasSectionCreationPermission = Auth::user()->hasSectionCreationPermission($parentId);
        if($parentId!=0) $childSectionMode = true;
        else $childSectionMode = false;
        return view('createProject', ['person'=>Auth::user(), 'user'=>Auth::user(), 'isMyself'=>true, 'parentId'=>$parentId, 'childSectionMode'=>$childSectionMode, 'hasSectionCreationPermission'=>$hasSectionCreationPermission]);
    }

    public function isAllowed($picture) {
        $allowed_extentions = array('jpg', 'jpeg', 'png', 'gif');
        $profile_pic_extention = strtolower($picture->clientExtension());

        return in_array($profile_pic_extention, $allowed_extentions);
    }

    public function processInputImage($section, $picture, $is_logo) {
        try {
            $logoDirectory = "images/logos";
            $coverDirectory = "images/covers";
            $fileNameNew = uniqid('', true).'.'.strtolower($picture->clientExtension());

            if($is_logo) {
                $picture->move($logoDirectory, $fileNameNew);
                $section->logo_path = $logoDirectory.'/'.$fileNameNew;
            } else {
                $picture->move($coverDirectory, $fileNameNew);
                $section->section_image_path = $coverDirectory.'/'.$fileNameNew;
            }

            return true;
        } catch (Exception $e) {
            return false;
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $section = new Section();
        $section->parent_id = $_POST['parent_id'];
        $section->section_type = $_POST['section_type'];
        $section->completion_status = $_POST['completion_status'];
        $section->name = $_POST['name'];
        $section->description = $_POST['description'];

        $logo = $request->file('logo');
        $cover_picture = $request->file('cover_pic');

        if(isset($logo) && $logo->isValid()) {
            if(!$this->isAllowed($logo)) return "You can not upload files of this type";
            if(!$this->processInputImage($section, $logo, true)) return "There was a problem moving the uploaded image to destination";
        } else {
            if($section->parent_id!=0) {
                $section->logo_path = null;
            }
        }

        if(isset($cover_picture) && $cover_picture->isValid()) {
            if(!$this->isAllowed($cover_picture)) return "You can not upload files of this type";
            if(!$this->processInputImage($section, $cover_picture, false)) return "There was a problem moving the uploaded image to destination";
        } else {
            if($section->parent_id!=0) {
                $section->section_image_path = null;
            }
        }

        $section->save();

        $adminMembership = new Membership();
        $adminMembership->user_id = Auth::user()->id;
        $adminMembership->role_id = Role::getSection('admin')->id;
        $section->memberships()->save($adminMembership);

        Auth::user()->subscribe($section->id);

//        return redirect()->back();
        return redirect()->route('project.show', ['id'=>$section->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $section = Section::findOrFail($id);
        $user = Auth::user();
        $role = $user->getRole($id);
        $role = $role->role_name;
        $isMember = $user->isMember($section->id);
        $logoPath = $section->getLogoPath();
        $coverPath = $section->getCoverPath();
        $posts = [];
        if(!$isMember) $posts = $section->getPublicPosts();
        else $posts = $section->posts()->latest()->get();
        $hasPostPermission = $user->hasPostPermission($section->id);
        $userMode = false;
        return view('project', compact(['section', 'user', 'role', 'isMember', 'logoPath', 'coverPath', 'posts', 'hasPostPermission', 'userMode']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

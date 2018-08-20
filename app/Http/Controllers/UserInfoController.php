<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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


    public function isAllowed($picture) {
        $allowed_extentions = array('jpg', 'jpeg', 'png', 'gif');
        $profile_pic_extention = strtolower($picture->clientExtension());

        return in_array($profile_pic_extention, $allowed_extentions);
    }

    public function processInputImage($picture, $is_profile_picture) {
        try {
            $directory = "images/propics";
            $fileNameNew = uniqid('', true).'.'.strtolower($picture->clientExtension());

            $picture->move($directory, $fileNameNew);

            if($is_profile_picture) {
                $inf = Auth::user()->info;
                $inf->profile_pic_path = $directory.'/'.$fileNameNew;
                $inf->save();
            } else {
                $sec = Auth::user()->getUserSection();
                $sec->section_image_path = $directory.'/'.$fileNameNew;
                $sec->save();
            }

            return true;
        } catch (Exception $e) {
            return false;
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $profile_picture = $request->file('profile_pic');
        $cover_picture = $request->file('cover_pic');

        if(isset($profile_picture) && $profile_picture->isValid()) {
            if(!$this->isAllowed($profile_picture)) return "You can not upload files of this type";
            if(!$this->processInputImage($profile_picture, true)) return "There was a problem moving the uploaded image to destination";
        }

        if(isset($cover_picture) && $cover_picture->isValid()) {
            if(!$this->isAllowed($cover_picture)) return "You can not upload files of this type";
            if(!$this->processInputImage($cover_picture, false)) return "There was a problem moving the uploaded image to destination";
        }

        return redirect()->back();
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

<?php

namespace App\Http\Controllers;

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        define ('SITE_ROOT', 'C:\xampp\htdocs\connectapp\public');

        $propic = $_FILES['profile_pic'];
        $cover = $_FILES['cover_pic'];

        $propic_name = $propic['name'];
        $propic_tmp_name = $propic['tmp_name'];
        $propic_size = $propic['size'];
        $propic_error = $propic['error'];
        $propic_type = $propic['type'];

        $cover_name = $cover['name'];
        $cover_tmp_name = $cover['tmp_name'];
        $cover_size = $cover['size'];
        $cover_error = $cover['error'];
        $cover_type = $cover['type'];

        $ext2 = explode('.', $propic_name);
        $propic_ext = end( $ext2);
        $propic_ext = strtolower($propic_ext);

        $ext1 = explode('.', $cover_name);
        $cover_ext = end( $ext1);
        $cover_ext = strtolower($cover_ext);

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        if(in_array($propic_ext, $allowed)) {
            if($propic_error==0) {
                $fileNameNew = uniqid('', true).'.'.$propic_ext;
                $fileDest = SITE_ROOT.'\images\propics\\'.$fileNameNew;
                $saveDest = '/images/propics/'.$fileNameNew;

                $inf = Auth::user()->info;
                $inf->profile_pic_path = $saveDest;
                $inf->save();

                move_uploaded_file($propic_tmp_name, $fileDest);
            } else {
                echo "There was and error uploading your file!";
            }
        } else {
            echo "You can not upload files of this type";
        }

        if(in_array($cover_ext, $allowed)) {
            if($cover_error==0) {
                $fileDest = SITE_ROOT.'\images\propics\\'.$fileNameNew;
                $saveDest = '/images/propics/'.$fileNameNew;

                $sec = Auth::user()->getUserSection();
                $sec->section_image_path = $saveDest;
                $sec->save();

                move_uploaded_file($propic_tmp_name, $fileDest);
            } else {
                echo "There was and error uploading your file!";
            }
        } else {
            echo "You can not upload files of this type";
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

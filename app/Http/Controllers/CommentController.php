<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\SimpleNotification;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->content = $_POST['content'];
        $comment->post_id = $_POST['post_id'];
        $comment->save();

        $post = Post::find($comment->post_id);
        $section = $post->section;
        $notification = new SimpleNotification();
        $notification->recepient_id = $post->writer->id;
        $notification->link = Route('post.show', $comment->post_id);
        $notification->image_to_show = Auth::user()->getProfilePicPath();
        $notification->notification_text = Auth::user()->name.' commented on your post';
        if(!$section->isUserSection()) $notification->notification_text = $notification->notification_text.' on '.$section->name;
        $notification->save();

        return redirect(Route('post.show', [$_POST['post_id']]));
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

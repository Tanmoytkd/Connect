<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
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
        if(isset($_POST['postButton'])) {

            if(isset($_POST['post_id'])) {
                $post=Post::findOrFail($_POST['post_id']);
            } else {
                $post = new Post();
            }
            $post->section_id = $_POST['section_id'];
            $post->content = $_POST['content'];
            $post->user_id = Auth::user()->id;
            if(isset($_POST['privacy_level'])) {
                $post->privacy_level = $_POST['privacy_level'];
            }
            $post->save();
            return redirect(Route('post.show', [$post->id]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $person = $post->writer;
        $user = Auth::user();
        $isMyself = $person->id == Auth::user()->id;
        return view('singlePostPage', compact( ['id', 'person', 'user', 'isMyself', 'post']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $user = Auth::user();
        if($post->writer->id != $user->id) return redirect()->back();
        return view('editPost', ['userMode'=>true, 'sectionId'=>$post->section->id, 'postContent'=>$post->content, 'person'=>Auth::user(), 'isMyself'=>true, 'user'=>$user, 'post'=>$post]);
        return view('widgets.writePost', ['userMode'=>true, 'sectionId'=>$post->section->id, 'postContent'=>$post->content]);
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
    public function destroy($postId)
    {
        $post = Post::findOrFail($postId);
        $post->delete();
        $writer = $post->writer;
        return redirect(Route('profile.show', [$writer->id]));
    }

    public function toggleLike($postId) {
        $user = Auth::user();
        $user->toggleLike($postId);

        return redirect(Route('post.show', [$postId]));
    }
}

@extends('profile')

@section('createPost')
    @include('widgets.createPostModal')
@endsection

@section('mainContentWithName')
    <p>&nbsp;</p>
    {!! view('widgets.writePost', ['userMode'=>true, 'sectionId'=>$post->section->id, 'postContent'=>$post->content, 'post'=>$post]) !!}
@endsection

@extends('profile')

@section('createPost')
    @include('widgets.createPostModal')
@endsection

@section('mainContent')
    {!! view('widgets.post', compact(['post'])) !!}
@endsection

@extends('layouts.standardPageLayout')

@php
    $section = $post->section;
    $user = Auth::user();
    $role = $user->getRole($section->id);
    if($role!="guest") $role = $role->role_name;
    $isMember = $user->isMember($section->id);
    $logoPath = $section->getLogoPath();
    $coverPath = $section->getCoverPath();
    $hasPostPermission = $isMember;
    $userMode = ($section->section_type == 'user');
@endphp

@section('init')
    @include('widgets.createPostModal')
@endsection

@section('header')
    <img src="{{asset($coverPath)}}" style="object-fit: cover;"
         height="278px" alt="">
@endsection

@section('leftSideBar')
    @if($userMode)
        @include('widgets.userProfileSideBarWidget')
    @else
        @include('widgets.projectLeftSideBarWidget')
    @endif
@endsection

@section('rightSideBar')
    @include('widgets.ads')
@endsection

@section('mainContent')
    <p>&nbsp;</p>
    {!! view('widgets.writePost', ['userMode'=>true, 'sectionId'=>$post->section->id, 'postContent'=>$post->content, 'post'=>$post]) !!}
@endsection

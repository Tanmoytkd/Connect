@extends('layouts.standardPageLayout')

@section('title')Post | {{$post->writer->name}} @parent  @endsection

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

@section('mainContent')
    @if(!$userMode)
        @include('widgets.sectionHeader')
    {{--@else--}}
        {{--@php--}}
            {{--$person = $post->writer;--}}
        {{--@endphp--}}
        {{--@include('widgets.userHeader')--}}
    @endif
    {!! view('widgets.post', compact(['post'])) !!}
@endsection

@section('rightSideBar')
    @include('widgets.ads')
@endsection

@extends('layouts.standardPageLayout')

@php
    use App\Section;
    if(!isset($childSectionMode)) $childSectionMode=false;

    if($childSectionMode) $sectionType = "section";
    else $sectionType = "project";

    if(!isset($parentId)) $parentId=0;
    $parentName = Section::findOrFail($parentId)->name;
@endphp

@section('title')Create {!! ucfirst($sectionType) !!} | @parent @endsection

@section('header')
    @if(!$childSectionMode)
        <img src="{{asset($person->getUserSection()->section_image_path)}}" style="object-fit: cover;"
         height="278px" alt="">
    @else
        @php
            $section = Section::findOrFail($parentId);
            $logoPath = $section->getLogoPath();
            $coverPath = $section->getCoverPath();
        @endphp
        <img src="{{asset($coverPath)}}" style="object-fit: cover;"
             height="278px" alt="">
    @endif
@endsection

@section('leftSideBar')
    @if(!$childSectionMode)
        @include('widgets.userProfileSideBarWidget')
    @else
        @php
            $section = Section::findOrFail($parentId);
            $user = Auth::user();
            $role = $user->getRole($parentId);
            $role = $role->role_name;
            $isMember = $user->isMember($section->id);
            $logoPath = $section->getLogoPath();
            $coverPath = $section->getCoverPath();

            $hasPostPermission = $isMember;
            $userMode = false;
        @endphp
        @include('widgets.projectLeftSideBarWidget')
    @endif
@endsection

@section('rightSideBar')
    @include('widgets.ads')
@endsection

@if($hasSectionCreationPermission)
    @section('mainContent')
        {{Form::open(array('action' => ['ProjectController@store', Auth::user()->id], 'method'=>'post', 'files' => true))}}
        @csrf

        <div class="Subhead">
            <h2 class="Subhead-heading">Create a new {{$sectionType}}</h2>
            <p class="Subhead-description">
                @if(!$childSectionMode)
                    Create a new project for your company, business or even personal creative purposes...
                @else
                    Create a new section in {{$parentName}}.
                @endif
            </p>
        </div>
        <input type="hidden" name="parent_id" value="{{$parentId}}">
        <input type="hidden" name="section_type" value="{{$sectionType}}">
        <input type="hidden" name="completion_status" value="running">

        <h2 style="margin-bottom: 10px">{!! ucfirst($sectionType) !!} Name:</h2>
        <input type="text" name="name" required>
        <br><br>

        <h2 style="margin-bottom: 10px">{!! ucfirst($sectionType) !!} Description: (Optional)</h2>
        <textarea name="description" rows="9" class="parentWidth"></textarea>
        <br><br>

        <h2 style="margin-bottom: 10px">{!! ucfirst($sectionType) !!} Logo:</h2>
        <input type="file" name="logo" @if(!$childSectionMode)required @endif >
        <br><br><br>
        <h2 style="margin-bottom: 10px">{!! ucfirst($sectionType) !!} Cover Image:</h2>
        <input type="file" name="cover_pic" @if(!$childSectionMode)required @endif >
        <br><br><br>
        <button type="submit" class="btn btn-success" name="Create Project">
            Create {!! ucfirst($sectionType) !!}
        </button>

        {{Form::close()}}
    @endSection
@else
    @section('mainContent')
        <div style="text-align: center; margin-top: 50px">
            <img src="{{asset('images/connect-logo-2.png')}}" alt="" width="250px" style="float: none;display: block;margin: auto">
            <h2 class="lead text-danger" style="display: block; margin-top: 20px">Oops!!! You don't have permission to create section here</h2>
        </div>
    @endsection
@endif

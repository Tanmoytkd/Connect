@extends('layouts.standardPageLayout')

@section('title')Create Project | @parent @endsection

@section('header')
    <img src="{{asset($person->getUserSection()->section_image_path)}}" style="object-fit: cover;"
         height="278px" alt="">
@endsection

@section('leftSideBar')
@include('widgets.userProfileSideBarWidget')
@endsection

@section('rightSideBar')
    @include('widgets.ads')
@endsection

@section('mainContent')
    {{Form::open(array('action' => ['ProjectController@store', Auth::user()->id], 'method'=>'post', 'files' => true))}}
    @csrf

    <div class="Subhead">
        <h2 class="Subhead-heading">Create a new Project</h2>
        <p class="Subhead-description">
            Create a new project for your company, business or even personal creative purposes...
        </p>
    </div>
    <input type="hidden" name="parent_id" value="0">
    <input type="hidden" name="section_type" value="project">
    <input type="hidden" name="completion_status" value="running">

    <h2 style="margin-bottom: 10px">Project Name:</h2>
    <input type="text" name="name" required>
    <br><br>

    <h2 style="margin-bottom: 10px">Project Description: (Optional)</h2>
    <textarea name="description" rows="9" class="parentWidth"></textarea>
    <br><br>

    <h2 style="margin-bottom: 10px">Project Logo:</h2>
    <input type="file" name="logo" required>
    <br><br><br>
    <h2 style="margin-bottom: 10px">Project Cover Image:</h2>
    <input type="file" name="cover_pic" required>
    <br><br><br>
    <button type="submit" class="btn btn-success" name="Create Project">
        Create Project
    </button>

    {{Form::close()}}
@endSection

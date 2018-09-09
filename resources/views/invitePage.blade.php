@php
    use App\User;
    use Illuminate\Support\Facades\Auth;
    use App\Section;
@endphp


@extends('layouts.standardPageLayout')

@section('leftSideBar')
    @if($sectionId==null)
        @php
            $person = User::findOrFail($userId);
            $isMyself = ($person->id == Auth::user()->id);
            $coverPath = $person->getCoverPicPath();
        @endphp
        @include('widgets.userProfileSideBarWidget')
    @else
        @php
            $section = Section::findOrFail($sectionId);
            $user = Auth::user();
            $role = $user->getRole($sectionId);
            $role = $role->role_name;
            $isMember = $user->isMember($section->id);
            $logoPath = $section->getLogoPath();
            $coverPath = $section->getCoverPath();
            $hasPostPermission = $user->hasPostPermission($section->id);
            $userMode = false;
        @endphp
        @include('widgets.projectLeftSideBarWidget')
    @endif
@endsection


@section('title') Invite | @parent @endsection

@section('init')
    @include('widgets.createPostModal')
@endsection

@section('header')
    <img src="{{asset($coverPath)}}" style="object-fit: cover;"
         height="278px" alt="">
@endsection

@section('rightSideBar')
    @include('widgets.ads')
@endsection

@section('mainContent')
    {{Form::open(array('action' => 'GeneralController@makeInvitation', 'method'=>'post', 'files' => true))}}
    <ul>
        <li>
            <h2 class="lead text-center">Invite Users</h2><br>
        </li>
        <li>
            <h2>User Id:<span>&nbsp;&nbsp;</span></h2>
            <input type="text" name="userId" value="{{$userId}}">
        </li>
        <br><br>
        <li>
            <h2>Project or Section Id:<span>&nbsp;&nbsp;</span></h2>
            <input type="text" name="sectionId" value="{{$sectionId}}">
        </li>
        <br><br>
        <li>
            <input type="submit" class="btn btn-success" name="inviteBtn"
                   value="Invite">
        </li>
    </ul>
    {{Form::close()}}
@endSection

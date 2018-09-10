@extends('profile')

@php
    $person = Auth::user();
    $user = Auth::user();
    $isMyself = true;
@endphp

@section('title') Projects | @parent @endsection

@section('mainContent')
    @include('widgets.userProjectSection')
@endsection

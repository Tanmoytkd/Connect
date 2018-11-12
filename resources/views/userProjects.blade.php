@extends('profile')

@php
    $person = Auth::user();
    $user = Auth::user();
    $isMyself = true;
@endphp

@section('title') Projects | @parent @endsection

@section('mainContent')
    @php
    echo view('widgets.userProjectSection', compact('person', 'user', 'isMyself'))
    @endphp
@endsection

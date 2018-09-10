@extends('profile')

@section('title') Payment | @parent @endsection

@php
    use Illuminate\Support\Facades\Auth;
    $person = Auth::user();
    $isMyself = true;
    $user = Auth::user();
@endphp

@section('mainContent')
    @if($mode == 'sendMoney')
        @include('widgets.sendMoney')
    @endif
@endsection

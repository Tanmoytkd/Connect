@php
    $person = Auth::user();
    $user = Auth::user();
    $isMyself = true;
@endphp

@extends('profile')

@section('title') Notifications | @parent @endsection

@section('mainContent')
    <div class="nt-title">
        <h4>Setting</h4>
        <a href="{{Route('clearNotifications')}}" title="">Clear all</a>
    </div>
    <table class="table table-hover">
        @php
            $notifications = Auth::user()->notifications()->latest()->get();
            if($notifications->count()==0) $unavailable = true;
            $notifications = $notifications->all();
        @endphp

        @if(isset($unavailable) && $unavailable==true)
            <div><p style="text-align: center; margin: 20px; padding: 30px" class="lead">No notifications available</p>
            </div>
        @endif

        @foreach($notifications as $notification)
            @php
                $imageToShow = $notification->image_to_show;
                $notificationText = $notification->notification_text;
                $notificationLink = $notification->link;
                if($notification->link==null) $notificationLink = "#";
            @endphp
            @include('widgets.singleNotificationFullPage')
        @endforeach

    </table>
@endsection

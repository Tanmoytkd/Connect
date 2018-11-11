<a href="{{$notificationLink}}">
{{--    @if(!isset($fullNotificationsPageMode))--}}
        <div class="notfication-details container">

            <div class="col-3" style="padding: 0px;float:left;">
                <img class="img-circle" style="width: 100%; float: none"
                     src="{{asset($imageToShow)}}" alt="">
            </div>

            <div class=" col-9" style="padding: 0px; float:left;">
                <h3 class="text-body" style="font-size: 16px; float: left; font-weight: normal; text-align: left; padding-left: 10px">{{$notificationText}}</h3>
                {{--<span>2 min ago</span>--}}
            </div><!--notification-info -->

        </div>
    {{--@endif--}}
</a>

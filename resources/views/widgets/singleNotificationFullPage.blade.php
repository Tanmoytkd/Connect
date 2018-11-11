<tr style="cursor: pointer" onclick="location.href='{{$notificationLink}}';">
        <td>
            <a href="{{$notificationLink}}">
                <img style="width: 3rem; float: left"
                     src="{{asset($imageToShow)}}" alt="">
            </a>
        </td>
        <td>
            <a href="{{$notificationLink}}">
                <p style="font-weight: normal; float: left; margin-left: 10px">{{$notificationText}}</p>
            </a>
        </td>
        {{--<span>2 min ago</span>--}}
</tr>

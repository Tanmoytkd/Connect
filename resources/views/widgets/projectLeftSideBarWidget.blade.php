<div class="user_profile">
    <div class="user-pro-img" style="margin-bottom: 0px">
        <img src="{{asset($logoPath)}}" height="185px"
             width="185px" alt="" style="background-color: #ffffffe5; object-fit: cover;">

        {{--<a href="#" title=""><i class="fa fa-camera"></i></a>--}}
    </div><!--user-pro-img end-->
    <div class="user_pro_status">

        <a href="{{route('project.show', ['id'=>$section->id])}}" style="text-align: center; display: block" title="">
            <h1 class="lead"
                style="color: #0d2041; font-size: 2rem; margin-bottom: 20px;text-align: center;">{{$section->name}}</h1>
        </a>
        {{--@if(!$isMember)--}}
        <ul class="flw-hr">
            <li>
                @if(!Auth::user()->isSubscriber($section->id))
                    <a href="{{Route('follow', ['sectionId'=>$section->id])}}"
                       title="" class="flww "><i class="la la-plus "></i>Follow</a>
                @else
                    <a href="{{Route('unfollow', ['sectionId'=>$section->id])}}"
                       title="" class="flww btn-danger"><i class="la la-plus"></i>
                        Following</a>
                @endif
            </li>
            <li>
                {!! Form::open(['method'=>'post', 'action' => 'RequestController@manageRequest' ]) !!}
                {!! Form::hidden('section_id', $section->id) !!}

                @if(Auth::user()->isMember($section->id))
                    {!! Form::hidden('mode', 'leave') !!}
                    <input type="submit" title="" class="btn btn-danger" value="Leave"/>
                @elseif(Auth::user()->hasRequestedToJoin($section->id))
                    {!! Form::hidden('mode', 'cancelJoinRequest') !!}
                    <input type="submit" title="" class="secondary btn btn-danger" value="Pending"/>
                @elseif(Auth::user()->isGuest($section->id))
                    {!! Form::hidden('mode', 'requestToJoin') !!}
                    <input type="submit" title="" class="btn btn-primary" value="Join"/>
                @endif
                {!! Form::close() !!}
            </li>
        </ul>
        {{--@else--}}
        @if($hasPostPermission)
            <ul class="flw-hr">
                <li>
                    <a href="#" data-toggle="modal" data-target="#myModal" class="btn-success">Write Post</a>
                </li>
            </ul>
        @endif

        @if(Auth::user()->hasSectionCreationPermission($section->id))
            <ul class="flw-hr">
                <li>
                    <a href="{{Route('createSection', ['parentId'=>$section->id])}}" class="btn btn-dark">Create
                        Section</a>
                </li>
            </ul>
        @endif

        {{--@endif--}}

        <ul class="flw-status">
            <li>
                <span>Members</span>
                <b>{{$section->memberships->count()}}</b>
            </li>
            <li>
                <span>Followers</span>
                <b>{{$section->subscribers->count()}}</b>
            </li>
        </ul>
    </div><!--user_pro_status end-->
</div><!--user_profile end-->

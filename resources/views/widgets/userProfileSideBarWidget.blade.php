<div class="user_profile">
    <div class="user-pro-img">
        <img src="{{asset($person->info->profile_pic_path)}}" height="185px"
             width="185px" alt="">

        {{--<a href="#" title=""><i class="fa fa-camera"></i></a>--}}
    </div><!--user-pro-img end-->
    <div class="user_pro_status">

        @if(!$isMyself)
            <ul class="flw-hr">

                <li>
                    @if(!Auth::user()->isSubscriber($person->getUserSection()->id))
                        <a href="{{Route('follow', ['sectionId'=>$person->getUserSection()->id])}}"
                           title="" class="flww "><i class="la la-plus "></i>Follow</a>
                    @else
                        <a href="{{Route('unfollow', ['sectionId'=>$person->getUserSection()->id])}}"
                           title="" class="flww btn-danger"><i class="la la-plus"></i>
                            Following</a>
                    @endif
                </li>
                <li><a href="#" title="" class="hre">Projects</a></li>
            </ul>
        @else
            <ul class="flw-hr">
                <li>
                    <a href="{{Route('project.create')}}" class="btn-success">Create Project</a>
                </li>
            </ul>
        @endif

        <ul class="flw-status">
            @if($isMyself)
                {!! view('widgets.moneySection', compact(['person'])) !!}
            @endif
            <li>
                <span>Subscriptions</span>
                <b>{{$person->subscriptions->count()}}</b>
            </li>
            <li>
                <span>Followers</span>
                <b>{{$person->getUserSection()->subscribers->count()}}</b>
            </li>
        </ul>
    </div><!--user_pro_status end-->
</div><!--user_profile end-->

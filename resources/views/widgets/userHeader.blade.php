@if(isset($person))
    <div class="user-tab-sec">
        <h3><a href="{{Route('profile.show', [$person->id])}}"
               class="text-secondary"
               style="color:darkslategray">{{$person->name}}</a></h3>
        <div class="star-descp">
            <span>{{$person->info->info}}</span>
            {{--<ul>--}}
            {{--<li><i class="fa fa-star"></i></li>--}}
            {{--<li><i class="fa fa-star"></i></li>--}}
            {{--<li><i class="fa fa-star"></i></li>--}}
            {{--<li><i class="fa fa-star"></i></li>--}}
            {{--<li><i class="fa fa-star-half-o"></i></li>--}}
            {{--</ul>--}}
            {{--<a href="#" title="">Status</a>--}}
        </div><!--star-descp end-->
    </div>
@endif

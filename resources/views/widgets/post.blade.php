@php
use Illuminate\Support\Facades\Auth;
$user = Auth::user();
@endphp
<div class="post-bar">
    <div class="post_topbar">
        <div class="usy-dt">
            <img src="{{asset($post->writer->info->profile_pic_path)}}" width="50" alt="">
            <div class="usy-name">
                <h3><a href="{{Route('profile.show', [$post->writer->id])}}" class="" style="color:darkslategray">{{$post->writer->name}}</a></h3>
                <span><img src="{{asset('images/old/clock.png')}}" alt=""  >{{$post->updated_at->diffForHumans()}}</span>
            </div>
        </div>
        @if($post->writer->id==$user->id)
        <div class="ed-opts">
            <a href="#" title="" class="ed-opts-open"><i
                    class="fa fa-ellipsis-v"></i></a>
            <ul class="ed-options">
                <li><a href="{{Route('post.edit', [$post->id])}}" title="">Edit Post</a></li>
                <li>
                    {{ Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'delete']) }}
                        @csrf
                        <input style="border: none; background: none;color: #686868;font-size: 14px;font-weight: 600;cursor: pointer;" type="submit" value="Delete">
                    {{ Form::close() }}
                </li>
                <li><a href="{{Route('post.show', [$post->id])}}" title="" >View Post</a> </li>
            </ul>
        </div>
        @endif
    </div>
    <div class="epi-sec">

        <ul class="bk-links">
            <li><a href="#" title=""><i class="fa fa-bookmark"></i></a></li>
            <li><a href="{{Route('messages.show', [$post->writer->id])}}"  title=""><i class="fa fa-envelope"></i></a></li>
        </ul>
    </div>
    <div class="job_descp">
        @if(isset($sectionInfo))<h3>{{$sectionInfo}}</h3>@endif
        {{--<ul class="job-dt">--}}
            {{--<li><a href="#" title="">Full Time</a></li>--}}
            {{--<li><span>$30 / hr</span></li>--}}
        {{--</ul>--}}
        <p>{!! $post->content !!}</p>
        {{--<ul class="skill-tags">--}}
            {{--<li><a href="#" title="">HTML</a></li>--}}
            {{--<li><a href="#" title="">PHP</a></li>--}}
            {{--<li><a href="#" title="">CSS</a></li>--}}
            {{--<li><a href="#" title="">Javascript</a></li>--}}
            {{--<li><a href="#" title="">Wordpress</a></li>--}}
        {{--</ul>--}}
    </div>
    <div class="job-status-bar">
        <ul class="like-com">
            <li>
                <a href="{!! Route('post.toggleLike', ['postId'=>$post->id]) !!}">
                    @if(!$user->hasLiked($post->id))
                        <i class="fa fa-heart-o" style="color: red;"></i> Like
                    @else <i class="fa fa-heart" style="color: red;"></i> Unlike
                    @endif
                </a>
                <img src="{{asset('images/old/liked-img.png')}}" alt="">
                <span>{{$post->likesCount()}}</span>
            </li>
            <li><a href="" title="" class="com" data-toggle="collapse" data-target="#comments{{$post->id}}"><img src="{{asset('images/old/com.png')}}"
                                                      alt=""> Comments <b class="text-muted">({{$post->commentCount()}})</b></a>
            </li>
        </ul>
    </div>
    <div id="comments{{$post->id}}" class="collapse">
        <ul>
        @foreach($post->comments as $comment)
                <li class="active">
                    <a href="{{Route('profile.show', [$comment->commenter->id])}}">
                        <div class="usr-msg-details" style="margin-top: 10px; padding-bottom: 5px; border-bottom: 1px solid #e5e5e5;">
                            <div class="usr-ms-img">
                                <img src="{{asset($comment->commenter->info->profile_pic_path)}}" style="margin-left: 20px" alt="">
                                <!--<span class="msg-status"></span>-->
                            </div>
                            <div class="usr-mg-info" style="float: left;margin-left: 20px">
                                <h3>{{$comment->commenter->name}}</h3>
                                <p>{{$comment->content}}</p>
                            </div><!--usr-mg-info end-->
                            <!--<span class="posted_time">'.$timeText.'</span> -->
                            <!-- <span class="msg-notifc">1</span> -->

                        </div>
                    </a><!--usr-msg-details end-->
                </li>
        @endforeach
        </ul>

        {!!view('widgets.comment', ['postId'=>$post->id, 'post'=>$post])!!}
    </div>

</div><!--post-bar end-->

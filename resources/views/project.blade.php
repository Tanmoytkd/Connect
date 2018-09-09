@extends('layouts.standardPageLayout')

@section('title') {{$section->name}} | @parent @endsection

@section('init')
    @include('widgets.createPostModal')
@endsection

@section('header')
    <img src="{{asset($coverPath)}}" style="object-fit: cover;"
         height="278px" alt="">
@endsection

@section('leftSideBar')
    @include('widgets.projectLeftSideBarWidget')
@endsection

@section('rightSideBar')
    @include('widgets.ads')
@endsection

@section('mainContent')
    @include('widgets.sectionHeader')

@section('mainContentWithName')
    <div class="user-tab-sec">
        <div class="tab-feed st2">
            <ul>
                <li data-tab="feed-dd" class="active">
                    <a href="#" title="">
                        <img src="{{asset('images/old/ic1.png')}}" alt="">
                        <span>Feed</span>
                    </a>
                </li>
                {{--<li data-tab="info-dd">--}}
                {{--<a href="#" title="">--}}
                {{--<img src="{{asset('images/old/ic2.png')}}" alt="">--}}
                {{--<span>Update Info</span>--}}
                {{--</a>--}}
                {{--</li>--}}
                @if(Auth::user()->hasUserAcceptPermission($section->id))
                    <li data-tab="my-bids">
                        <a href="#" title="">
                            <img src="{{asset('images/old/ic5.png')}}" alt="">
                            <span>Requests</span>
                        </a>
                    </li>
                @endif
                <li data-tab="portfolio-dd">
                    <a href="#" title="">
                        <img src="{{asset('images/old/ic3.png')}}" alt="">
                        <span>Sections</span>
                    </a>
                </li>
                <li data-tab="payment-dd">
                    <a href="#" title="">
                        <img src="{{asset('images/old/ic6.png')}}" alt="">
                        <span>Members</span>
                    </a>
                </li>
            </ul>
        </div><!-- tab-feed end-->
    </div><!--user-tab-sec end-->
    <div class="product-feed-tab current" id="feed-dd">
        <div class="posts-section">
            @section('posts')
                @foreach($posts as $post)
                    {!! view('widgets.post', compact(['post'])) !!}
                @endforeach
            @show
        </div><!--posts-section end-->
    </div><!--product-feed-tab end-->
    {{--<div class="product-feed-tab" id="info-dd">--}}
    {{--<div class="user-profile-ov">--}}
    {{--{{Form::open(array('action' => ['UserInfoController@update', Auth::user()->id], 'method'=>'put', 'files' => true))}}--}}
    {{--@csrf--}}

    {{--<h2 style="margin-bottom: 10px">Profile Picture: </h2>--}}
    {{--<input type="file" name="profile_pic">--}}
    {{--<br><br>--}}
    {{--<h2 style="margin-bottom: 10px">Cover Pic: </h2>--}}
    {{--<input type="file" name="cover_pic">--}}
    {{--<br><br>--}}
    {{--<button type="submit" class="btn btn-success" name="Save Changes">Save--}}
    {{--changes--}}
    {{--</button>--}}

    {{--{{Form::close()}}--}}
    {{--</div><!--user-profile-ov end-->--}}
    {{--</div><!--product-feed-tab end-->--}}
    @if(Auth::user()->hasUserAcceptPermission($section->id))
        <div class="product-feed-tab" id="my-bids">
            <div class="profiles-slider">
                @php
                    $allRequests = $section->requests()->where('request_type', 'join_request')->get()->all();
                @endphp

                @foreach ($allRequests as $request)
                    @php
                        $currentMember = $request->requester;
                    @endphp

                    {{--////////////////////--}}

                    <div class="user-profy card"
                         style="padding-top:  10px; width: calc(33.3% - 6px); margin-right: 6px">
                        <div class="user-pro-img" style="margin-top: 5px;">
                            <img src="{{asset($currentMember->getProfilePicPath())}}" height="143px"
                                 width="143px" alt="">
                        </div>
                        <div class="card-body" style="padding: 5px; padding-top: 10px;">
                            <h3 style="height: 2em;overflow: hidden;">{{$currentMember->name}}</h3>
                            {{--<span>{{$currentMember->getUserSection()->subscribers()}} Followers</span>--}}

                            <ul style="height: 5em; overflow: hidden">
                                <li>
                                    <a href="{{Route('acceptRequest', ['requestId'=>$request->id])}}"
                                       title="" class="followw" style="margin: 5px"><i class="la la-plus "></i>Accept</a>
                                </li>
                                <li>
                                    <a href="{{Route('rejectRequest', ['requestId'=>$request->id])}}" title="" class="btn btn-danger" style="margin: 5px">Reject</a>
                                </li>
                                <li>
                                    <a href="{{Route('messages.show', [$currentMember->id])}}" title="" class="envlp bg-primary" style="margin: 5px">
                                        <i class="fa fa-handshake-o"></i> Negotiate</a>
                                </li>
                            </ul>
                            <a href="{{Route('profile.show', ['id'=>$currentMember->id])}}" title=""
                               class="btn btn-light " style="width: 100%; background-color: #f7f7f7">View Profile</a></div>
                    </div>
                @endforeach
            </div><!--profiles-slider end-->
        </div><!--product-feed-tab end-->
    @endif
    <div class="product-feed-tab" id="portfolio-dd">
        <div class="portfolio-gallery-sec">
            <h3>Sections</h3>
            <div class="gallery_pf">
                <div class="row">
                    @php
                        $childSections = $section->childSections->all();
                    @endphp
                    @foreach($childSections as $project)

                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <div class="gallery_pt">
                                <img src="{{asset($project->getLogoPath())}}" alt="">
                                <a href="{{route('project.show', ['id'=>$project->id])}}" class="disabled" about="blank"
                                   style="cursor: crosshair;" title="">
                                    <h1 class="btn btn-dark"
                                        style="margin-lef: 0px; margin-right: 0px; padding-left: 0px; padding-right: 0px; text-align: center; background-color: #e5e5e507; border: 0.1px; font-weight: 400;">{{$project->name}}</h1>
                                </a>
                            </div><!--gallery_pt end-->
                            <a href="{{route('project.show', ['id'=>$project->id])}}"
                               style="text-align: center; display: block" title="">
                                <h1 class="btn btn-light"
                                    style="margin-lef: 0px; margin-right: 0px; padding-left: 0px; padding-right: 0px; text-align: center; font-weight: 400;">{{$project->name}}</h1>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div><!--gallery_pf end-->
        </div><!--portfolio-gallery-sec end-->
    </div><!--product-feed-tab end-->
    <div class="product-feed-tab" id="payment-dd">

        <div class="top-profiles">
            <div class="pf-hd">
                <h3>Members</h3>
                <i class="fa fa-ellipsis-v"></i>
            </div>
            <div class="profiles-slider">
                @php
                    $allMemberships = $section->memberships()->get()->all();
                @endphp

                @foreach ($allMemberships as $membership)
                    @php
                        $currentMember = $membership->user;
                        $currentRole = $membership->role;
                    @endphp

                    {{--////////////////////--}}

                    <div class="user-profy card"
                         style="padding-top:  10px; width: calc(33.3% - 6px); margin-right: 6px">
                        <div class="user-pro-img" style="margin-top: 5px;">
                            <img src="{{asset($currentMember->getProfilePicPath())}}" height="143px"
                                 width="143px" alt="">
                        </div>
                        {{--<div class="image-cropper">--}}
                        {{--<img src="{{asset($currentUser->getProfilePicPath())}}" alt="avatar" class="profile-pic">--}}
                        {{--</div>--}}
                        {{--<img src="{{asset($currentUser->getProfilePicPath())}}" alt=""--}}
                        {{--class="card-img-top rounded-circle"--}}
                        {{--style="margin-right: auto; margin-left: auto; width: 80%;">--}}
                        <div class="card-body" style="padding: 5px; padding-top: 10px;">
                            <h3 style="height: 2em;overflow: hidden;"><a style="color: #101010;" href="{{Route('profile.show', ['id'=>$currentMember->id])}}">{{$currentMember->name}}</a></h3>
                            <span>{{$currentRole->role_name}}</span>
                            @if(Auth::user()->isAdmin($section->id))
                            <div style="margin-bottom: 15px">
                                <a title="make admin" href="{{Route('makeAdmin', ['sectionId'=>$section->id, 'userId'=>$currentMember->id])}}"><i class="fa fa-diamond btn-md btn-success"></i></a>
                                <a title="make manager" href="{{Route('makeManager', ['sectionId'=>$section->id, 'userId'=>$currentMember->id])}}"><i class="fa  fa-gavel btn-md btn-outline-success"></i></a>
                                <a title="make member" href="{{Route('makeMember', ['sectionId'=>$section->id, 'userId'=>$currentMember->id])}}"><i class="fa fa-user btn-md btn-secondary"></i></a>
                                <a title="kick out" href="{{Route('kick', ['sectionId'=>$section->id, 'userId'=>$currentMember->id])}}"><i class="fa fa-remove btn-md btn-danger"></i></a>
                            </div>
                            @endif
                            <ul style="height: 6em; overflow: hidden">
                                <li>
                                    @if(!Auth::user()->isSubscriber($currentMember->getUserSection()->id))
                                        <a href="{{Route('follow', ['sectionId'=>$currentMember->getUserSection()->id])}}"
                                           title="" class="followw" style="margin: 5px"><i class="la la-plus "></i>Follow</a>
                                    @else
                                        <a href="{{Route('unfollow', ['sectionId'=>$currentMember->getUserSection()->id])}}"
                                           title="" class="followw btn-danger" style="margin: 5px"><i
                                                class="la la-plus"></i>
                                            Following</a>
                                    @endif
                                </li>
                                {{--<li><a href="{{Route('follow', ['sectionId'=>$person->getUserSection()->id])}}" title="" class="followw" style="margin: 5px">Follow</a></li>--}}
                                <li><a href="#" title="" class="hire" style="margin: 5px">Invite</a></li>
                                <li><a href="{{Route('messages.show', [$currentMember->id])}}" title="" class="envlp bg-success" style="margin: 5px"><img
                                            src="http://connect.com/images/old/envelop.png" alt=""> Message</a></li>
                            </ul>
                            <a href="{{Route('profile.show', ['id'=>$currentMember->id])}}" title=""
                               class="btn btn-light " style="width: 100%; background-color: #f7f7f7">View
                                Profile</a></div>
                    </div>

                    {{--////////////////////--}}

                    {{--<div class="user-profy card"--}}
                    {{--style="padding-top:  10px; width: calc(33.3% - 6px); margin-right: 6px">--}}
                    {{--<img src="{{asset($currentMember->getProfilePicPath())}}" alt=""--}}
                    {{--class="card-img-top rounded-circle"--}}
                    {{--style="margin-right: auto; margin-left: auto; width: 80%;">--}}
                    {{--<div class="card-body" style="padding: 5px; padding-top: 10px;">--}}
                    {{--<h3>{{$currentMember->name}}</h3>--}}
                    {{--<span>{{$currentRole->role_name}}</span>--}}

                    {{--<ul>--}}
                    {{--<li>--}}
                    {{--@if(!Auth::user()->isSubscriber($currentMember->getUserSection()->id))--}}
                    {{--<a href="{{Route('follow', ['sectionId'=>$currentMember->getUserSection()->id])}}"--}}
                    {{--title="" class="followw" style="margin: 5px"><i class="la la-plus "></i>Follow</a>--}}
                    {{--@else--}}
                    {{--<a href="{{Route('unfollow', ['sectionId'=>$currentMember->getUserSection()->id])}}"--}}
                    {{--title="" class="followw btn-danger" style="margin: 5px"><i class="la la-plus"></i>--}}
                    {{--Following</a>--}}
                    {{--@endif--}}
                    {{--</li>--}}
                    {{--<li><a href="{{Route('follow', ['sectionId'=>$person->getUserSection()->id])}}" title="" class="followw" style="margin: 5px">Follow</a></li>--}}
                    {{--<li><a href="#" title="" class="hire" style="margin: 5px">Invite</a></li>--}}
                    {{--<li><a href="#" title="" class="envlp bg-success" style="margin: 5px"><img--}}
                    {{--src="http://connect.com/images/old/envelop.png" alt=""> Message</a></li>--}}
                    {{--</ul>--}}
                    {{--<a href="{{Route('profile.show', ['id'=>$currentUser->id])}}" title="" class="btn btn-light " style="width: 100%; background-color: #f7f7f7">View--}}
                    {{--Profile</a></div>--}}
                    {{--</div>--}}
                @endforeach
            </div><!--profiles-slider end-->
        </div><!--top-profiles end-->

    </div><!--product-feed-tab end-->
@show
@endsection

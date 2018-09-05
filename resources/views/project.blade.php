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

                <li data-tab="my-bids">
                    <a href="#" title="">
                        <img src="{{asset('images/old/ic5.png')}}" alt="">
                        <span>Requests</span>
                    </a>
                </li>
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

                {{--<div class="process-comm">--}}
                {{--<div class="spinner">--}}
                {{--<div class="bounce1"></div>--}}
                {{--<div class="bounce2"></div>--}}
                {{--<div class="bounce3"></div>--}}
                {{--</div>--}}
                {{--</div><!--process-comm end-->--}}
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

    <div class="product-feed-tab" id="my-bids">

    </div><!--product-feed-tab end-->
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
                <h3>Top Profiles</h3>
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

                    <div class="user-profy card"
                         style="padding-top:  10px; width: calc(33.3% - 6px); margin-right: 6px">
                        <img src="{{asset($currentMember->getProfilePicPath())}}" alt=""
                             class="card-img-top rounded-circle"
                             style="margin-right: auto; margin-left: auto; width: 80%;">
                        <div class="card-body" style="padding: 5px; padding-top: 10px;">
                            <h3>{{$currentMember->name}}</h3>
                            <span>{{$currentRole->role_name}}</span>

                            <ul>
                                <li>
                                    @if(!Auth::user()->isSubscriber($currentMember->getUserSection()->id))
                                        <a href="{{Route('follow', ['sectionId'=>$currentMember->getUserSection()->id])}}"
                                           title="" class="followw" style="margin: 5px"><i class="la la-plus "></i>Follow</a>
                                    @else
                                        <a href="{{Route('unfollow', ['sectionId'=>$currentMember->getUserSection()->id])}}"
                                           title="" class="followw btn-danger" style="margin: 5px"><i class="la la-plus"></i>
                                            Following</a>
                                    @endif
                                </li>
                                {{--<li><a href="{{Route('follow', ['sectionId'=>$person->getUserSection()->id])}}" title="" class="followw" style="margin: 5px">Follow</a></li>--}}
                                <li><a href="#" title="" class="hire" style="margin: 5px">Invite</a></li>
                                <li><a href="#" title="" class="envlp bg-success" style="margin: 5px"><img
                                            src="http://connect.com/images/old/envelop.png" alt=""> Message</a></li>
                            </ul>
                            <a href="#" title="" class="btn btn-light " style="width: 100%; background-color: #f7f7f7">View
                                Profile</a></div>
                    </div>
                @endforeach
            </div><!--profiles-slider end-->
        </div><!--top-profiles end-->

    </div><!--product-feed-tab end-->
@show
@endsection

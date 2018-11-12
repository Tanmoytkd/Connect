@extends('layouts.standardPageLayout')

@section('title')Search results of "{{$searchQuery}}" | @parent @endsection

@section('init')

@endsection

@section('header')
    <img src="{{asset($person->getUserSection()->section_image_path)}}" style="object-fit: cover;"
         height="278px" alt="">
@endsection

@section('leftSideBar')
    @include('widgets.userProfileSideBarWidget')
@endsection

@section('mainContent')
    <div class="user-tab-sec">
        <h2 style="display: inline-block; padding-bottom: 5px; margin-bottom: 10px;color:darkslategray; font-size: 24px;">
            Search results of "{{$searchQuery}}"
        </h2>

        <hr style="margin-bottom: 9px;margin-top: 0px;">
    </div>

    <div class="user-tab-sec">
        <div class="tab-feed st2">
            <ul>
                <li data-tab="feed-dd" class="active">
                    <a href="#" title="">
                        <img src="{{asset('images/old/person.png')}}" alt="">
                        <span>Users</span>
                    </a>
                </li>
                <li data-tab="portfolio-dd">
                    <a href="#" title="">
                        <img src="{{asset('images/old/ic3.png')}}" alt="">
                        <span>Projects</span>
                    </a>
                </li>
                <li data-tab="payment-dd">
                    <a href="#" title="">
                        <img src="{{asset('images/old/sections.png')}}" alt="">
                        <span>Sections</span>
                    </a>
                </li>
            </ul>
        </div><!-- tab-feed end-->
    </div><!--user-tab-sec end-->
    <div class="product-feed-tab current" id="feed-dd">
        <div class="portfolio-gallery-sec">
            @if(empty($users))
                <div style="text-align: center">
                    <h1 class="text-secondary">No User Found</h1>
                </div>
            @endif
            @foreach($users as $currentUser)
                <div class="user-profy card"
                     style="padding-top:  10px; width: calc(33.3% - 6px); margin-right: 6px">
                    <a style="padding: 0px; margin: 0px;" class="text-body"
                       href="{{Route('profile.show', $currentUser->id)}}">
                        <div class="user-pro-img" style="margin-top: 5px;">
                            <img src="{{asset($currentUser->getProfilePicPath())}}" height="143px"
                                 width="143px" alt="">
                        </div>
                    </a>
                    {{--<div class="image-cropper">--}}
                    {{--<img src="{{asset($currentUser->getProfilePicPath())}}" alt="avatar" class="profile-pic">--}}
                    {{--</div>--}}
                    {{--<img src="{{asset($currentUser->getProfilePicPath())}}" alt=""--}}
                    {{--class="card-img-top rounded-circle"--}}
                    {{--style="margin-right: auto; margin-left: auto; width: 80%;">--}}
                    <div class="card-body" style="padding: 5px; padding-top: 10px;">

                        <h3 style="height: 2em;overflow: hidden;"><a class="text-body"
                                                                     href="{{Route('profile.show', $currentUser->id)}}">{{$currentUser->name}}</a>
                        </h3>
                        <span>{{$currentUser->getUserSection()->subscribers->count()}} Followers</span>

                        <ul style="height: 7em; overflow: hidden">
                            <li>
                                @if(!Auth::user()->isSubscriber($currentUser->getUserSection()->id))
                                    <a href="{{Route('follow', ['sectionId'=>$currentUser->getUserSection()->id])}}"
                                       title="" class="followw" style="margin: 5px"><i
                                            class="la la-plus "></i>Follow</a>
                                @else
                                    <a href="{{Route('unfollow', ['sectionId'=>$currentUser->getUserSection()->id])}}"
                                       title="" class="followw btn-danger" style="margin: 5px"><i
                                            class="la la-plus"></i>
                                        Following</a>
                                @endif
                            </li>
                            {{--<li><a href="{{Route('follow', ['sectionId'=>$person->getUserSection()->id])}}" title="" class="followw" style="margin: 5px">Follow</a></li>--}}
                            <li><a href="#" title="" class="hire" style="margin: 5px">Invite</a></li>
                            <li><a href="#" title="" class="envlp bg-success" style="margin: 5px"><img
                                        src="http://connect.com/images/old/envelop.png" alt=""> Message</a></li>
                        </ul>
                        <a href="{{Route('profile.show', ['id'=>$currentUser->id])}}" title="" class="btn btn-light "
                           style="width: 100%; background-color: #f7f7f7">View
                            Profile</a></div>
                </div>
            @endforeach

        </div><!--posts-section end-->
    </div><!--product-feed-tab end-->

    <div class="product-feed-tab" id="portfolio-dd">
        <div class="portfolio-gallery-sec">
            @if(empty($projects))
                <div style="text-align: center">
                    <h1 class="text-secondary">No Project Found</h1>
                </div>
            @else
                <h3 class="text-body">Projects</h3>
            @endif
            <div class="gallery_pf">
                <div class="row">
                    @foreach($projects as $project)
                        @php
                        echo view('widgets.projectCard', ['project'=>$project])
                        @endphp
                    @endforeach
                </div>
            </div><!--gallery_pf end-->
        </div><!--portfolio-gallery-sec end-->
    </div><!--product-feed-tab end-->
    <div class="product-feed-tab" id="payment-dd">
        <div class="portfolio-gallery-sec">
            @if(empty($sections))
                <div style="text-align: center">
                    <h1 class="text-secondary">No Section Found</h1>
                </div>
            @else
                <h3>Sections</h3>
            @endif
            <div class="gallery_pf">
                <div class="row">
                    @foreach($sections as $currentSection)
                        @php
                            echo view('widgets.projectCard', ['project'=>$currentSection])
                        @endphp
                    @endforeach
                </div>
            </div><!--gallery_pf end-->
        </div><!--portfolio-gallery-sec end-->
    </div><!--product-feed-tab end-->



@endsection

@section('rightSideBar')
    @include('widgets.ads')
@endsection

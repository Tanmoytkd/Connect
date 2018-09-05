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
        <div class="posts-section">
            @if(empty($users))
                <div style="text-align: center">
                    <h1 class="text-secondary">No User Found</h1>
                </div>
            @endif
            @foreach($users as $currentUser)
                <div class="user-profy card"
                     style="padding-top:  10px; width: calc(33.3% - 6px); margin-right: 6px">
                    <div class="user-pro-img" style="margin-top: 5px;">
                        <img src="{{asset($currentUser->getProfilePicPath())}}" height="143px"
                             width="143px" alt="">
                    </div>
                    {{--<div class="image-cropper">--}}
                        {{--<img src="{{asset($currentUser->getProfilePicPath())}}" alt="avatar" class="profile-pic">--}}
                    {{--</div>--}}
                    {{--<img src="{{asset($currentUser->getProfilePicPath())}}" alt=""--}}
                         {{--class="card-img-top rounded-circle"--}}
                         {{--style="margin-right: auto; margin-left: auto; width: 80%;">--}}
                    <div class="card-body" style="padding: 5px; padding-top: 10px;">
                        <h3 style="height: 2em;overflow: hidden;">{{$currentUser->name}}</h3>
                        <span>{{$currentUser->getUserSection()->subscribers->count()}} Followers</span>

                        <ul style="height: 5em; overflow: hidden">
                            <li>
                                @if(!Auth::user()->isSubscriber($currentUser->getUserSection()->id))
                                    <a href="{{Route('follow', ['sectionId'=>$currentUser->getUserSection()->id])}}"
                                       title="" class="followw" style="margin: 5px"><i class="la la-plus "></i>Follow</a>
                                @else
                                    <a href="{{Route('unfollow', ['sectionId'=>$currentUser->getUserSection()->id])}}"
                                       title="" class="followw btn-danger" style="margin: 5px"><i class="la la-plus"></i>
                                        Following</a>
                                @endif
                            </li>
                            {{--<li><a href="{{Route('follow', ['sectionId'=>$person->getUserSection()->id])}}" title="" class="followw" style="margin: 5px">Follow</a></li>--}}
                            <li><a href="#" title="" class="hire" style="margin: 5px">Invite</a></li>
                            <li><a href="#" title="" class="envlp bg-success" style="margin: 5px"><img
                                        src="http://connect.com/images/old/envelop.png" alt=""> Message</a></li>
                        </ul>
                        <a href="{{Route('profile.show', ['id'=>$currentUser->id])}}" title="" class="btn btn-light " style="width: 100%; background-color: #f7f7f7">View
                            Profile</a></div>
                </div>
            @endforeach

        </div><!--posts-section end-->
    </div><!--product-feed-tab end-->

    <div class="product-feed-tab" id="portfolio-dd">
        <div class="portfolio-gallery-sec">
            <h3>Projects</h3>
            <div class="gallery_pf">
                <div class="row">
                    @foreach($projects as $project)

                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <div class="gallery_pt">
                                <img src="{{asset($project->getLogoPath())}}" alt="">
                                <a href="{{route('project.show', ['id'=>$project->id])}}" class="disabled" about="blank" style="cursor: crosshair;" title="">
                                    <h1 class="btn btn-dark" style="text-align: center; background-color: #e5e5e507; border: 0.1px; font-weight: 400;">{{$project->name}}</h1>
                                </a>
                            </div><!--gallery_pt end-->
                            <a href="{{route('project.show', ['id'=>$project->id])}}" style="text-align: center; display: block" title="">
                                <h1 class="btn btn-light" style="margin: auto;text-align: center; font-weight: 400;font-size: 17px; width:100%;">{{$project->name}}</h1>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div><!--gallery_pf end-->
        </div><!--portfolio-gallery-sec end-->
    </div><!--product-feed-tab end-->
    <div class="product-feed-tab" id="payment-dd">
        <div class="portfolio-gallery-sec">
            <h3>Sections</h3>
            <div class="gallery_pf">
                <div class="row">
                    @foreach($sections as $currentSection)

                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <div class="gallery_pt">
                                <img src="{{asset($currentSection->getLogoPath())}}" alt="">
                                <a href="{{route('project.show', ['id'=>$currentSection->id])}}" class="disabled" about="blank" style="cursor: crosshair;" title="">
                                    <h1 class="btn btn-dark" style="text-align: center; background-color: #e5e5e507; border: 0.1px; font-weight: 400;">{{$currentSection->name}}</h1>
                                </a>
                            </div><!--gallery_pt end-->
                            <a href="{{route('project.show', ['id'=>$currentSection->id])}}" style="text-align: center; display: block" title="">
                                <h1 class="btn btn-light" style="margin: auto;text-align: center; font-weight: 400;font-size: 17px; width:100%;">{{$currentSection->name}}</h1>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div><!--gallery_pf end-->
        </div><!--portfolio-gallery-sec end-->
    </div><!--product-feed-tab end-->



@endsection

@section('rightSideBar')
    @include('widgets.ads')
@endsection



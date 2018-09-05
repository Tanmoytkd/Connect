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
    <div class="user-tab-sec">
        <h2 style="display: inline-block; padding-bottom: 5px; margin-bottom: 10px;">
            @php
                $sections = collect([]);
                $sec = $section;
                while($sec->section_type != 'master') {
                    $sections->push($sec);
                    $sec = $sec->getParent();
                }
                $sections = $sections->reverse();
                $first = true;
            @endphp


            @foreach($sections as $sec)
                @php
                    if($first) $first=false;
                    else echo " > ";
                @endphp
                <a href="{{Route('project.show', [$section->id])}}"
                   style="color:darkslategray; font-size: 24px">{{$section->name}}</a>
            @endforeach
            &nbsp;
        </h2>
        <p style="line-height: 18px;">
            {{$section->description}}
        </p>
        <hr style="margin-bottom: 9px;">
    </div>

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
                @yield('posts')
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
                                    <a href="{{route('project.show', ['id'=>$project->id])}}" class="disabled" about="blank" style="cursor: crosshair;" title="">
                                        <h1 class="btn btn-dark" style="margin-lef: 0px; margin-right: 0px; padding-left: 0px; padding-right: 0px; text-align: center; background-color: #e5e5e507; border: 0.1px; font-weight: 400;">{{$project->name}}</h1>
                                    </a>
                                </div><!--gallery_pt end-->
                                <a href="{{route('project.show', ['id'=>$project->id])}}" style="text-align: center; display: block" title="">
                                    <h1 class="btn btn-light" style="margin-lef: 0px; margin-right: 0px; padding-left: 0px; padding-right: 0px; text-align: center; font-weight: 400;">{{$project->name}}</h1>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div><!--gallery_pf end-->
            </div><!--portfolio-gallery-sec end-->
        </div><!--product-feed-tab end-->
        <div class="product-feed-tab" id="payment-dd">

        </div><!--product-feed-tab end-->
    @show
@endsection

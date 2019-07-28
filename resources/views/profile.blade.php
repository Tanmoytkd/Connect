@php
    use App\Section;
@endphp
@extends('layouts.standardPageLayout')

@section('title'){{$person->name}} | @parent @endsection

@section('init')
    @yield('createPost')
@endsection

@section('header')
    <img src="{{asset($person->getUserSection()->section_image_path)}}" style="object-fit: cover;"
         height="278px" alt="">
@endsection

@section('leftSideBar')
    @include('widgets.userProfileSideBarWidget')
@endsection

@section('rightSideBar')
    <div class="message-btn">
        <a href="{{Route('messages.show', [$person->id])}}" title=""><i
                class="fa fa-envelope"></i> Message</a>
    </div>
    @if($isMyself)
        <div class="message-btn">
            <a href="#" data-toggle="modal" data-target="#myModal"
               style="margin-right: 10px">Write Post</a>
        </div>
    @endif
    @include('widgets.ads')
@endsection

@section('mainContent')
    @include('widgets.userHeader')
    @section('mainContentWithName')
        <div class="user-tab-sec">
            <div class="tab-feed st2">
                <ul>
                    <li data-tab="feed-dd" class="active">
                        <a href="#" title="">
                            <img src="{{asset('images/old/ic1.png')}}" alt="">
                            <span>Posts</span>
                        </a>
                    </li>
                    @if($person->id == Auth::user()->id)
                        <li data-tab="info-dd">
                            <a href="#" title="">
                                <img src="{{asset('images/old/ic2.png')}}" alt="">
                                <span>Update Info</span>
                            </a>
                        </li>

                        <li data-tab="my-bids">
                            <a href="#" title="">
                                <img src="{{asset('images/old/ic5.png')}}" alt="">
                                <span>Invitations</span>
                            </a>
                        </li>
                    @endif
                    <li data-tab="portfolio-dd">
                        <a href="#" title="">
                            <img src="{{asset('images/old/ic3.png')}}" alt="">
                            <span>Projects</span>
                        </a>
                    </li>
                    <li data-tab="payment-dd">
                        <a href="#" title="">
                            <img src="{{asset('images/old/ic6.png')}}" alt="">
                            <span>Payment</span>
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
        <div class="product-feed-tab" id="info-dd">
            <div class="user-profile-ov">
                {{Form::open(array('action' => ['UserInfoController@update', Auth::user()->id], 'method'=>'put', 'files' => true))}}
                @csrf

                <h2 style="margin-bottom: 10px">Basic Info: (Optional)</h2>
                <textarea name="basicInfo" rows="4" class="parentWidth">{{$user->info->info}}</textarea>
                <br><br>

                <h2 style="margin-bottom: 10px">Profile Picture: </h2>
                <input type="file" name="profile_pic">
                <br><br>
                <h2 style="margin-bottom: 10px">Cover Pic: </h2>
                <input type="file" name="cover_pic">
                <br><br>
                <button type="submit" class="btn btn-success" name="Save Changes">Save
                    changes
                </button>

                {{Form::close()}}
            </div><!--user-profile-ov end-->
        </div><!--product-feed-tab end-->

        <div class="product-feed-tab" id="my-bids">
            @include('widgets.invitations')
        </div><!--product-feed-tab end-->
        <div class="product-feed-tab" id="portfolio-dd">
            <div class="portfolio-gallery-sec">
                @include('widgets.userProjectSection')
            </div><!--portfolio-gallery-sec end-->
        </div><!--product-feed-tab end-->
        <div class="product-feed-tab" id="payment-dd">
            @include('widgets.sendMoney')
        </div><!--product-feed-tab end-->
    @show
@endsection

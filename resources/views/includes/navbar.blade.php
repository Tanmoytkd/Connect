<header id="myheader">
    <div class="container">
        <div class="header-data">
            <div id="logo-connect">
                <h1>
                    <a href="{{Route('/')}}">
                        C<img src="{{asset('images/connect-logo-2.png')}}" style="height: 1em; float: none; vertical-align: sub" />nnect
                    </a>
                </h1>
            </div><!--logo end-->
            <div class="search-bar">
                <form method="get" action="{{Route('search')}}">
                    @php
                        $searchQuery = "";
                        if(isset($_GET['search'])) $searchQuery = $_GET['search'];
                    @endphp
                    <input type="text" name="search" placeholder="Search..." value="{{$searchQuery}}">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>

            <div class="menu-btn">
                <a href="#" title=""><i class="fa fa-bars"></i></a>
            </div><!--menu-btn end-->
            <div class="user-account">
                <div class="user-info">
                    <img src="{{asset(Auth::user()->info->profile_pic_path)}}" style="height: 1.5em; width: 1.5em;" alt="">
                    <a href="#" title=""><b>{{Auth::user()->getFirstName()}}</b></a>
                    <i class="la la-sort-down"></i>
                </div>
                <div class="user-account-settingss">
                    <h3>
                        <a class="text-body" href="{{Route('profile.show', Auth::user()->id)}}">Profile</a>
                    </h3>
                    <h3>Setting</h3>
                    <ul class="us-links">
                        <li><a href="#" title="">Account Setting</a></li>
                        <li><a href="#" title="">Privacy</a></li>
                        <li><a href="#" title="">Faqs</a></li>
                        <li><a href="#" title="">Terms & Conditions</a></li>
                    </ul>
                    <h3 class="tc">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <b>{{ __('Logout') }}</b>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </h3>
                </div><!--user-account-settingss end-->
            </div>
            <!--search-bar end-->
            <nav class="main-navigation">
                <ul>
                    <li>
                        <a href="{{url('/')}}" title="">
                            <span><img src="{{asset('images/old/icon1.png')}}" alt=""></span>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{Route('project.index')}}" title="">
                            <span><img src="{{asset('images/old/icon3.png')}}" alt=""></span>
                            Projects
                        </a>
                    </li>
                    {{--<li>--}}
                        {{--<a href="profiles.html" title="">--}}
                            {{--<span><img src="{{asset('images/old/icon4.png')}}" alt=""></span>--}}
                            {{--Profiles--}}
                        {{--</a>--}}
                        {{--<ul>--}}
                            {{--<li><a href="user-profile.html" title="">User Profile</a></li>--}}
                            {{--<li><a href="my-profile-feed.html" title="">my-profile-feed</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="jobs.html" title="">--}}
                            {{--<span><img src="{{asset('images/old/icon5.png')}}" alt=""></span>--}}
                            {{--Jobs--}}
                        {{--</a>--}}
                        {{--<ul>--}}
                            {{--<li>--}}
                                {{--<h1>tkd</h1>--}}
                                {{--<h1>js</h1>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    <li>
                        @if(!isset($messagePage))
                        <a href="#" title="" class="not-box-open">
                            <span><img src="{{asset('images/old/icon6.png')}}" alt=""></span>
                            Messages
                        </a>
                        @else
                        <a href="{{route('messages.index')}}" title="" class="not-box-open">
                            <span><img src="{{asset('images/old/icon6.png')}}" alt=""></span>
                            Messages
                        </a>
                        @endif
                        @if(!isset($messagePage))
                        <div class="notification-box msg">
                            <div class="nt-title">
                                <h4></h4>
                                <a href="#" title=""></a>
                            </div>

                            <div class="nott-list">

                                @include('includes.navbarMsg')

                                <div class="view-all-nots">
                                    <a href="{{route('messages.index')}}" title="">View All Messsages</a>
                                </div>
                            </div><!--nott-list end-->
                        </div><!--notification-box end-->
                        @endif
                    </li>
                    <li>
                        @if(!isset($messagePage))
                        <a href="#" title="" class="not-box-open">
                            <span><img src="{{asset('images/old/icon7.png')}}" alt=""></span>
                            Notification
                        </a>
                        @else
                        <a href="{{Route('notifications')}}" title="" class="not-box-open">
                            <span><img src="{{asset('images/old/icon7.png')}}" alt=""></span>
                            Notification
                        </a>
                        @endif
                        <div class="notification-box">
                            @if(!isset($messagePage))
                            <div class="nt-title">
                                <h4>Setting</h4>
                                <a href="{{Route('clearNotifications')}}" title="">Clear all</a>
                            </div>
                            <div class="nott-list">
                                @php
                                    $notifications = Auth::user()->notifications()->latest()->take(3)->get();
                                    if($notifications->count()==0) $unavailable = true;
                                    $notifications= $notifications->all();
                                @endphp

                                @if(isset($unavailable) && $unavailable==true)
                                    <p style="font-weight:normal; text-align: center">No notifications available</p>
                                @endif

                                @foreach($notifications as $notification)
                                    @php
                                        $imageToShow = $notification->image_to_show;
                                        $notificationText = $notification->notification_text;
                                        $notificationLink = $notification->link;
                                        if($notification->link==null) $notificationLink = "#";
                                    @endphp
                                    @include('widgets.singleNotification')
                                @endforeach
                                <div class="view-all-nots">
                                    <a href="{{Route('notifications')}}" title="">View All Notification</a>
                                </div>
                                @endif
                            </div><!--nott-list end-->
                        </div><!--notification-box end-->
                    </li>
                </ul>
            </nav>
            <!--nav end-->


        </div><!--header-data end-->
    </div>
</header>

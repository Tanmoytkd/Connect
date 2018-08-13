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
                <form>
                    <input type="text" name="search" placeholder="Search...">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>

            <div class="menu-btn">
                <a href="#" title=""><i class="fa fa-bars"></i></a>
            </div><!--menu-btn end-->
            <div class="user-account">
                <div class="user-info">
                    <img src="{{asset('')}}images/old/resources/user.png" alt="">
                    <a href="#" title=""><b>{{Auth::user()->getFirstName()}}</b></a>
                    <i class="la la-sort-down"></i>
                </div>
                <div class="user-account-settingss">
                    <h3>Online Status</h3>
                    <ul class="on-off-status">
                        <li>
                            <div class="fgt-sec">
                                <input type="radio" name="cc" id="c5">
                                <label for="c5">
                                    <span></span>
                                </label>
                                <small>Online</small>
                            </div>
                        </li>
                        <li>
                            <div class="fgt-sec">
                                <input type="radio" name="cc" id="c6">
                                <label for="c6">
                                    <span></span>
                                </label>
                                <small>Offline</small>
                            </div>
                        </li>
                    </ul>
                    <h3>Custom Status</h3>
                    <div class="search_form">
                        <form>
                            <input type="text" name="search">
                            <button type="submit">Ok</button>
                        </form>
                    </div><!--search_form end-->
                    <h3>Setting</h3>
                    <ul class="us-links">
                        <li><a href="profile-account-setting.html" title="">Account Setting</a></li>
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
                        <a href="" title="">
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
                        <a href="#" title="" class="not-box-open">
                            <span><img src="{{asset('images/old/icon6.png')}}" alt=""></span>
                            Messages
                        </a>
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
                    </li>
                    <li>
                        <a href="#" title="" class="not-box-open">
                            <span><img src="{{asset('images/old/icon7.png')}}" alt=""></span>
                            Notification
                        </a>
                        <div class="notification-box">
                            <div class="nt-title">
                                <h4>Setting</h4>
                                <a href="#" title="">Clear all</a>
                            </div>
                            <div class="nott-list">
                                <div class="notfication-details">
                                    <div class="noty-user-img">
                                        <img src="{{asset('images/old/resources/ny-img1.png')}}" alt="">
                                    </div>
                                    <div class="notification-info">
                                        <h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
                                        <span>2 min ago</span>
                                    </div><!--notification-info -->
                                </div>
                                <div class="notfication-details">
                                    <div class="noty-user-img">
                                        <img src="{{asset('images/old/resources/ny-img2.png')}}" alt="">
                                    </div>
                                    <div class="notification-info">
                                        <h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
                                        <span>2 min ago</span>
                                    </div><!--notification-info -->
                                </div>
                                <div class="notfication-details">
                                    <div class="noty-user-img">
                                        <img src="{{asset('images/old/resources/ny-img3.png')}}" alt="">
                                    </div>
                                    <div class="notification-info">
                                        <h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
                                        <span>2 min ago</span>
                                    </div><!--notification-info -->
                                </div>
                                <div class="notfication-details">
                                    <div class="noty-user-img">
                                        <img src="{{asset('images/old/resources/ny-img2.png')}}" alt="">
                                    </div>
                                    <div class="notification-info">
                                        <h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
                                        <span>2 min ago</span>
                                    </div><!--notification-info -->
                                </div>
                                <div class="view-all-nots">
                                    <a href="#" title="">View All Notification</a>
                                </div>
                            </div><!--nott-list end-->
                        </div><!--notification-box end-->
                    </li>
                </ul>
            </nav>
            <!--nav end-->


        </div><!--header-data end-->
    </div>
</header>

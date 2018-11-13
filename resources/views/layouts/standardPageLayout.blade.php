@extends('layouts.main')

{{--@section('title') @parent @endsection--}}

@section('content')

    <div class="container">

        <section class="cover-sec">
            @yield('header')
        </section>

        @yield('init')

        <main>
            <div class="main-section">
                <div class="container">
                    <div class="main-section-data">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="main-left-sidebar">
                                    @yield('leftSideBar')
                                </div><!--main-left-sidebar end-->
                            </div>

                            <div class="col-lg-6">
                                <div class="main-ws-sec">
                                    @yield('mainContent')
                                </div><!--main-ws-sec end-->
                            </div>

                            <div class="col-lg-3">
                                <div class="right-sidebar">
                                    @yield('rightSideBar')
                                </div><!--right-sidebar end-->
                            </div>
                        </div>
                    </div><!-- main-section-data end-->
                </div>
            </div>
        </main>

        <footer>
            <div class="footy-sec mn no-margin">
                <div class="container">
                    <ul>
                        <li><a href="#" title="">Help Center</a></li>
                        <li><a href="#" title="">Privacy Policy</a></li>
                        <li><a href="#" title="">Community Guidelines</a></li>
                        <li><a href="#" title="">Cookies Policy</a></li>
                        <li><a href="#" title="">Career</a></li>
                        <li><a href="#" title="">Forum</a></li>
                        <li><a href="#" title="">Language</a></li>
                        <li><a href="#" title="">Copyright Policy</a></li>
                    </ul>
                    <p><img src="{{asset('images/old/copy-icon2.png')}}" alt="">Copyright 2018</p>
                </div>
            </div>
        </footer><!--footer end-->

    </div><!--theme-layout end-->
@endsection

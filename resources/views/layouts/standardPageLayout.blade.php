@extends('layouts.main')

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
                    <p><img src="images/copy-icon2.png" alt="">Copyright 2018</p>
                    <img class="fl-rgt" src="images/logo2.png" alt="">
                </div>
            </div>
        </footer><!--footer end-->

    </div><!--theme-layout end-->



    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/flatpickr.min.js"></script>
    <script type="text/javascript" src="lib/slick/slick.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
@endsection

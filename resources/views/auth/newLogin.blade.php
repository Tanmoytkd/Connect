@php
    function isRegistrationPage() {
        $current = Route(Route::getFacadeRoot()->current()->uri());
        $register = Route('register');
        return $current==$register;
    }
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is social network html5 template available in themeforest......" />
    <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
    <meta name="robots" content="index, follow" />
    <title>{{ config('app.name', 'Connect') }}</title>

    <!-- Stylesheets
    ================================================= -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/loginstyle.css" />
    <link rel="stylesheet" href="css/ionicons.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

</head>
<body>


<div id="lp-register">
    <div class="container wrapper">
        <div class="row">
            <div class="col-sm-5">
                <div class="intro-texts">
                    <h1 class="text-white">Create, Collaborate,Innovate !!!</h1>
                    <p style="color: white">
                        We present you the idea of Ownership Shared Development (OSD) where developers get
                        a partial ownership of that particular project and earn a portion of subsequent profit
                        that project makes.
                    </p>
                    <a href="{{route('/')}}" class="btn btn-primary">Learn More</a>
                </div>
            </div>
            <div class="col-sm-6 col-sm-offset-1">
                <div class="reg-form-container">

                    <!-- Register/Login Tabs-->
                    <div class="reg-options" >
                        <ul class="nav nav-tabs">
                            <li @if(isRegistrationPage()) class="active" @endif id="reglink"><a href="#register" data-toggle="tab">Register</a></li>
                            <li @if(!isRegistrationPage()) class="active" @endif id="loginlink"><a href="#login" data-toggle="tab">Login</a></li>
                        </ul><!--Tabs End-->
                    </div>

                    <!--Registration Form Contents-->
                    <div class="tab-content">
                        <div class="tab-pane @if(isRegistrationPage()) active @endif " id="register" style="text-align: center">
                            <h3>Register Now !!!</h3>
                            <p class="text-muted" style="font-size: 14px">Be cool and join today. Meet millions</p>
                            <br>

                            <!--Register Form-->
                            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                                @csrf

                                <div class="form-group row">
                                    {{--<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

                                    <div class="col-md-12">
                                        <input id="name" type="text" placeholder="{{ __('Name') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                                    <div class="col-md-12">
                                        <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                                    <div class="col-md-12">
                                        <input id="password" placeholder="{{ __('Password') }}" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

                                    <div class="col-md-12">
                                        <input id="password-confirm" placeholder="{{ __('Confirm Password') }}" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                            {{ __('Register') }}
                                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!--Register Now Form Ends-->
                            <p>
                                <a href="#login" data-toggle="tab"
                                   onclick="document.getElementById('reglink').setAttribute('class', '');
                                            document.getElementById('loginlink').setAttribute('class', 'active')">
                                Already have an account? Login.
                                </a>
                            </p>
                        </div><!--Registration Form Contents Ends-->

                        <!--Login-->
                        <div class="tab-pane @if(!isRegistrationPage()) active @endif " id="login" style="text-align: center">
                            <h3>Login</h3>
                            <p class="text-muted">Log in to your account</p>

                            <!--Login Form-->
                            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                @csrf

                                <div class="form-group row">
                                    {{--<label for="email" class="col-sm-4 col-form-label text-md-right text-muted">{{ __('E-Mail Address') }}</label>--}}

                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{--<label for="password" class="col-md-4 col-form-label text-md-right text-muted">{{ __('Password') }}</label>--}}

                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label text-muted" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                            {{ __('Login') }}
                                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                        </button>
                                        <br>

                                        <a class="btn btn-link text-muted" href="{{ route('password.request') }}">
                                            <small>{{ __('Forgot Your Password?') }}</small>
                                        </a>
                                    </div>
                                </div>

                                <p>
                                    <a href="#register" data-toggle="tab"
                                       onclick="document.getElementById('reglink').setAttribute('class', 'active');
                                            document.getElementById('loginlink').setAttribute('class', '')">
                                        Don't have an account? Register.
                                    </a>
                                </p>
                            </form><!--Login Form Ends-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-6">

                <!--Social Icons-->
                <ul class="list-inline social-icons">
                    <li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
                    <li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
                    <li><a href="#"><i class="icon ion-social-googleplus"></i></a></li>
                    <li><a href="#"><i class="icon ion-social-pinterest"></i></a></li>
                    <li><a href="#"><i class="icon ion-social-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!--preloader-->
<div id="spinner-wrapper">
    <div class="spinner"></div>
</div>

<!-- Scripts
================================================= -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.appear.min.js"></script>
<script src="js/jquery.incremental-counter.js"></script>
<script src="js/script.js"></script>

</body>

<!-- Mirrored from thunder-team.com/friend-finder/index-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 22 Jul 2018 07:08:44 GMT -->
</html>

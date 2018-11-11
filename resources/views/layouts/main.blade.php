<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@section('title') {{config('app.name', 'Laravel')}} @show</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->

    @section('fonts')
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    @show


<!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @section('styles')
        @include('includes.styles')
    @show

</head>

<body>
<div class="wrapper">
    @include('includes.navbar')
</div>



<div id="app">
    @yield('content')
</div>

@section('scripts')
    @include('includes.script')
@show
</body>
</html>

@extends('layouts.main')

@section('content')

    {{--@php--}}
        {{--if(isset($_POST['postButton'])) {--}}
            {{--//echo $_POST['inputData'];--}}
        {{--}--}}
    {{--@endphp--}}

<div class="spacer">
    &nbsp;
</div>

@include('includes.tinyeditor')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        {!! Form::open(['method'=>'post', 'action' => 'HomeController@checker']) !!}

                            <input type="textarea" class="tinyEditor" name="inputData" id="inputData" >

                            <div class="d-flex justify-content-end">
                                <select name = "privacy">
                                    <option value="1">Public</option>
                                    <option value="2">Group Members Only</option>
                                </select>
                                <span style="width: 10px"></span>
                                <input type="submit" name="postButton" id="postButton">
                            </div>

                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

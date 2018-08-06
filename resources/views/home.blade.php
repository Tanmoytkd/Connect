@extends('layouts.app')

@section('content')

    {{--@php--}}
        {{--if(isset($_POST['postButton'])) {--}}
            {{--//echo $_POST['inputData'];--}}
        {{--}--}}
    {{--@endphp--}}

    <script>
        var selector = '#inputData';
        tinymce.init({
            selector: selector,
            plugins: 'image code',
            toolbar: 'undo redo | image code',

            // without images_upload_url set, Upload tab won't show up
            images_upload_url: 'upload.php',

            // override default upload handler to simulate successful upload
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;

                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', 'upload.php');

                xhr.onload = function() {
                    var json;

                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }

                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }

                    success(json.location);
                };

                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                xhr.send(formData);
            },
        });
    </script>

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

                            <input type="textarea" name="inputData" id="inputData" >
                            <br><br>
                            <input type="submit" name="postButton" id="postButton">
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

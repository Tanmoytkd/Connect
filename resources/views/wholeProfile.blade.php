@extends('profile')

@section('createPost')
    @if($isMyself)
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">Write Post</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        {!! view('widgets.writePost', ['userMode'=>true, 'sectionId'=>$user->getUserSection()->id]) !!}
                    </div>
                    {{--<div class="modal-footer">--}}
                        {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                    {{--</div>--}}
                </div>

            </div>
        </div>

    @endif
@endsection

@section('posts')
    @foreach($posts as $post)
        {!! view('widgets.post', compact(['post'])) !!}
    @endforeach

    @yield('pagination')

    {{--<div class="process-comm">--}}
    {{--<div class="spinner">--}}
    {{--<div class="bounce1"></div>--}}
    {{--<div class="bounce2"></div>--}}
    {{--<div class="bounce3"></div>--}}
    {{--</div>--}}
    {{--</div><!--process-comm end-->--}}
@endsection

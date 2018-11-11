@if((isset($isMyself) && $isMyself) || (isset($hasPostPermission) && $hasPostPermission))
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Write Post</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    @php
                    if(isset($isMyself) && $isMyself) {
                        $userMode = true;
                        $section = $user->getUserSection();
                    }
                    @endphp
                    {!! view('widgets.writePost', ['userMode'=>$userMode, 'sectionId'=>$section->id]) !!}
                </div>
                {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                {{--</div>--}}
            </div>

        </div>
    </div>

@endif

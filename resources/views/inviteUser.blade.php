@php
    use App\User;
    use Illuminate\Support\Facades\Auth;
    use App\Section;
@endphp


@extends('layouts.standardPageLayout')

@section('leftSideBar')
    @if($sectionId==null)
        @php
            $person = User::findOrFail($userId);
            $isMyself = ($person->id == Auth::user()->id);
            $coverPath = $person->getCoverPicPath();
        @endphp
        @include('widgets.userProfileSideBarWidget')
    @else
        @php
            $section = Section::findOrFail($sectionId);
            $user = Auth::user();
            $role = $user->getRole($sectionId);
            $role = $role->role_name;
            $isMember = $user->isMember($section->id);
            $logoPath = $section->getLogoPath();
            $coverPath = $section->getCoverPath();
            $hasPostPermission = $user->hasPostPermission($section->id);
            $userMode = false;
        @endphp
        @include('widgets.projectLeftSideBarWidget')
    @endif
@endsection


@section('title') Invite | @parent @endsection

@section('init')
    @include('widgets.createPostModal')
@endsection

@section('header')
    <img src="{{asset($coverPath)}}" style="object-fit: cover;"
         height="278px" alt="">
@endsection

@section('rightSideBar')
    @include('widgets.ads')
@endsection

@section('mainContent')

    <table class="table">
        <tr>
            <td class="text-center">Invite Users to {{Section::find($sectionId)->name}}</td>
        </tr>
        <tr>
            <td>
                <div class="input-group">
                    <input type="text" class="form-control" size="20" placeholder="Enter name here" id="receiverName">
                    <div class="input-group-btn">
                        <button class="btn btn-default" id="searchButton">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div
                {{--<input type="text" id="receiverName" size="25">--}}
            </td>
        </tr>
    </table>

    <table class="table table-hover">
        <tbody id="userResults">

        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            $('#searchButton').click(function () {
                var name = $('#receiverName').val();
                if (name === "") return;

                $.get('/userByName/' + name, function (data) {
                    data = JSON.parse(data);
                    $('#userResults').html("");
                    var token = '{{ csrf_field() }}';
                    $.each(data, function (index, user) {
                        // var htmlData = buildForm(index, user);
                        // $('#userResults').append(htmlData);
                        //////////////////////////////////////////////////////////////

                        $("#userResults").append(
                            // Creating Form Div and Adding <h2> and <p> Paragraph Tag in it.
                            $('<tr/>').append(
                                $('<td/>').append(
                                    //////////
                                    $("<form/>", {
                                        action: '{{Route('makeInvitation')}}',
                                        method: 'post'
                                    }).append(
                                        token,
                                        $("<input/>", {
                                            type: 'hidden',
                                            name: 'sectionId',
                                            value: ''+ {{$sectionId}}
                                        }),
                                        $("<input/>", {
                                            type: 'hidden',
                                            name: 'userId',
                                            value: ''+ user.id
                                        }),
                                        $("<table/>", {
                                            style: 'width:100%'
                                        }).append(
                                            $("<tr/>").append(
                                                $("<td/>").append(
                                                    $("<img/>", {
                                                        src: "/"+user.profile_pic_path,
                                                        style: 'width: 50px;height: 50px;object-fit: cover; border-radius: 100px'
                                                    })
                                                ),
                                                $("<td/>").append(
                                                    user.name + "<br><span class='small' style='color: darkslategray;'>" + user.info.info + "</span>"
                                                ),
                                                $("<td/>").append(
                                                    $("<button/>", {
                                                        class: 'btn btn-success',
                                                        type: 'submit',
                                                        style: 'float:right;'
                                                    }).text('Invite')
                                                )
                                            )
                                        )
                                    )

                                    /////////
                                )
                            )

                        )

                        //////////////////////////////////////////////////////////////
                    });

                });
            })
        });
    </script>

    {{--{{Form::open(array('action' => 'GeneralController@makeInvitation', 'method'=>'post', 'files' => true))}}--}}
    {{--<input type="hidden" name="sectionId" value="{{$sectionId}}">--}}
    {{--<ul>--}}
        {{--<li>--}}
            {{--<h2 class="lead ">Invite Users to {{Section::find($sectionId)->name}}</h2><br>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<h2>User Id:<span>&nbsp;&nbsp;</span></h2>--}}

            {{--<input type="text" name="userId" value="{{$userId}}">--}}
        {{--</li>--}}
        {{--<br><br>--}}
        {{--<li>--}}
            {{--<h2>Project or Section Id:<span>&nbsp;&nbsp;</span></h2>--}}

        {{--</li>--}}
        {{--<br><br>--}}
        {{--<li>--}}
            {{--<input type="submit" class="btn btn-success" name="inviteBtn"--}}
                   {{--value="Invite">--}}
        {{--</li>--}}
    {{--</ul>--}}
    {{--{{Form::close()}}--}}
@endSection

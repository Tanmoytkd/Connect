@php
    use Illuminate\Support\Facades\Auth;
    use App\Section;
    $invites = Auth::user()->inviteRequests()->latest()->get()->all();
@endphp
<table class="table table-borderless table-hover">
@foreach($invites as $invite)
    @php
        $sender = $invite->requester()->first();
        $senderName = $sender->name;
        $section = Section::find($invite->section_id);
        $sectionName = $section->name;
    @endphp
    <tr>
        <td>
            <img style="height: 3rem;" src="{{asset($section->getLogoPath())}}" alt="">
        </td>
        <td>
            <a href="{{Route('profile.show', $sender->id)}}" class="text-body">{{$senderName}}</a> has invited you to join <a
                href="{{Route('project.show', $section->id)}}" class="text-body">{{$sectionName}}</a> <br>

            <a href="{{Route('acceptRequest', ['requestId'=>$invite->id])}}"
               title="" class="btn btn-sm btn-success" style="margin: 5px; margin-left: 0px;"><i class="la la-plus "></i>Accept</a>
            <a href="{{Route('rejectRequest', ['requestId'=>$invite->id])}}" title="" class="btn btn-sm btn-danger" style="margin: 5px">Reject</a>
            <a href="{{Route('messages.show', [$invite->requester()->first()->id])}}" title="" class="btn btn-sm btn-primary" style="margin: 5px">
                <i class="fa fa-handshake-o"></i> Negotiate</a>
        </td>
    </tr>
@endforeach
</table>

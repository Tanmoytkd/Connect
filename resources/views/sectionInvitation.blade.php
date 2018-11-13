
<table class="table table-hover">
    @foreach ($projects as $project)
        <tr>
            <td>
                {{Form::open(array('action' => 'GeneralController@makeInvitation', 'method'=>'post', 'files' => true))}}
                <input type="hidden" name="userId" value="{{$userId}}">
                <input type="hidden" name="sectionId" value="{{$project->id}}">
                <table>
                    <tr>
                        <td style="vertical-align: middle">
                            <img src="{{"/".$project->getLogoPath()}}" alt="" style="width: 50px;height: 50px;object-fit: cover; border-radius: 100px">
                        </td>
                        <td>
                            @php
                                $sections = collect([]);
                                $sec = $project;
                                while($sec->section_type != 'master') {
                                    $sections->push($sec);
                                    $sec = $sec->getParent();
                                }
                                $sections = $sections->reverse();
                                $first = true;
                            @endphp


                            @foreach($sections as $sec)
                                @php
                                    if($first) $first=false;
                                    else echo " > ";
                                @endphp
                                <a href="{{Route('project.show', [$sec->id])}}"
                                   style="color:darkslategray; font-size: 24px">{{$sec->name}}</a>
                            @endforeach

                            <br>
                            <span class="small" style="color: darkslategray;"> {{$sec->description}}  </span>
                        </td>
                        <td style="vertical-align: middle;">
                            <button type="submit" class="btn btn-success">Invite</button>
                        </td>
                    </tr>
                </table>
                {{Form::close()}}
            </td>
        </tr>
    @endforeach
</table>

<div class="user-profy card"
     style="padding-top:  10px; width: calc(33.3% - 6px); margin-right: 6px">
    <a style="padding: 0px; margin: 0px;" class="text-body"
       href="{{route('project.show', ['id'=>$project->id])}}">
        <div class="user-pro-img" style="margin-top: 5px;">
            <img src="{{asset($project->getLogoPath())}}" height="143px"
                 width="143px" alt="">
        </div>
    </a>

    <div class="card-body" style="padding: 5px; padding-top: 10px;">
        <a style="padding: 0px; margin: 0px;" class="text-body"
           href="{{route('project.show', ['id'=>$project->id])}}">
            {{$project->name}}
        </a>
    </div>
</div>

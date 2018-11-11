<div class="gallery_pf">
    <div class="row">
        @php
            if(isset($sectionMode) && $sectionMode==true) {
                $projects = $person->getSections();
            } else {
                $projects = $person->getProjects();
            }

        @endphp
        @foreach($projects as $project)

            <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                <div class="gallery_pt">
                    <img src="{{asset($project->getLogoPath())}}" alt="">
                    <a href="{{route('project.show', ['id'=>$project->id])}}" class="disabled" about="blank" style="cursor: crosshair;" title="">
                        <h1 class="btn btn-dark" style="text-align: center; background-color: #e5e5e507; border: 0.1px; font-weight: 400;">{{$project->name}}</h1>
                    </a>
                </div><!--gallery_pt end-->
                <a href="{{route('project.show', ['id'=>$project->id])}}" style="text-align: center; display: block" title="">
                    <h1 class="btn btn-light" style="margin: auto;text-align: center; font-weight: 400;font-size: 17px; width: 100%;">{{$project->name}}</h1>
                </a>
            </div>
        @endforeach
    </div>
</div><!--gallery_pf end-->

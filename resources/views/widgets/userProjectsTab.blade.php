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
            @php
                echo view('widgets.projectCard', ['project'=>$project])
            @endphp
        @endforeach
    </div>
</div><!--gallery_pf end-->

<ul class="nav nav-tabs justify-content-center" role="tablist" style="margin-bottom: 27px">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#projects">Projects</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#sections">Sections</a>
    </li>
</ul>


<!-- Tab panes -->
<div class="tab-content">
    <div id="projects" class="container tab-pane active"><br>
        @php
        echo view('widgets.userProjectsTab', ['sectionMode'=>false, 'person'=>$person])
        @endphp
    </div>
    <div id="sections" class="container tab-pane fade"><br>
        @php
        echo view('widgets.userProjectsTab', ['sectionMode'=>true, 'person'=>$person])
        @endphp

    </div>
</div>


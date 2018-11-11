{{----------------------------}}

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
        @include('widgets.userProjectsTab')
    </div>
    <div id="sections" class="container tab-pane fade"><br>
        @php
            $sectionMode=true;
        @endphp
        @include('widgets.userProjectsTab')
    </div>
</div>
{{----------------------------}}

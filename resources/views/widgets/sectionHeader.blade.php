<div class="user-tab-sec">
    <h2 style="display: inline-block; padding-bottom: 5px; margin-bottom: 10px;">
        @php
            $sections = collect([]);
            $sec = $section;
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
        &nbsp;
    </h2>
    <p style="line-height: 18px;">
        {{$section->description}}
    </p>
    <hr style="margin-bottom: 9px;">
</div>

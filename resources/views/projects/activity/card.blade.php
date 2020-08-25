<div class="card mt-2">
    <ul>
            @foreach ($project->activity as $activity)
                <li>
                    @include("projects.activity.{$activity->description}") 
                    <span style="color:rgba(0, 0, 0, 0.4);font-size:16px">{{$activity->created_at->diffForHumans(null,true)}}</span>
                </li>
            @endforeach
    </ul>
</div>
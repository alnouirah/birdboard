@if (count($activity->changes['after']) == 2)
        @if ($activity->user->id == auth()->id())
                       You updated the {{ key($activity->changes['after']) }} of the project
        @else 
                {{ $activity->user->name }} updated the {{ key($activity->changes['after']) }} of the project
        @endif
@else
        You updated the project
@endif
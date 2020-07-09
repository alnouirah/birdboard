<div class="card" style="height:200px">
    <h3 class="font-normal text-xl py-4 -mx-5 mb-4 pl-4" style="border-left:4px solid #2da6ce">
    
        <a href="{{ $project->path() }}" class="text-black no-underline"> {{ $project->title }} </a>
    
    </h3>

    <div style="color: rgb(0,0,0,0.4)">
    
        {{ str_limit($project->description ,100) }}
    
    </div>
</div>
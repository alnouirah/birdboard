<html>
    <head>
        <title>testing projects</title>
    </head>
    <body>

        <h1>Projects</h1>
        <ul>
            @forelse ($projects as $project)
                <li><a href="{{ $project->path() }}">{{ $project->title }}</a></li>
            @empty
                <li>No project yet !</li>
            @endforelse
        </ul>

    </body>
</html>
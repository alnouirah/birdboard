

@extends('layouts.app')
@section('content')

        <header class="flex items-center mb-3">

                <div class="flex items-end justify-between w-full">

                <p style="color: rgba(0, 0, 0, 0.4)">
                        <a href="/projects">Projects</a> / {{ $project->title }}
                </p>

                <a href="{{ $project->path().'/edit' }}" style="padding: 5px;border-radius:4px;color:#fff;background:#2da6ce">Edit Project</a>
                </div>
        </header>

        <main>
                <div class="lg:flex -mx-3">
                        <div class="lg:w-3/4 px-3 mb-6">
                                <div class="mb-4">
                                        
                                        <h2 style="color: rgba(0, 0, 0, 0.4)" class="text-lg mb-3">Tasks</h2>
                                        
                                        @forelse ($project->tasks as $task)
                                        
                                                <div class="card mb-3">
                                                
                                                        <form method="POST" action="{{ $task->path() }}">
                                                                {{ method_field('PATCH') }}
                                                                {{ csrf_field() }}
                                                                
                                                                <div class="flex">

                                                                        <input class="w-full" type="text" name="body" value="{{ $task->body }}"/> 
                                                                        <input onchange="this.form.submit()" type="checkbox" name="compleated" {{ $task->compleated ? "checked":"" }} />
                                                                </div>
                                                        </form>
                                                
                                                </div>

                                        @empty
                                            
                                        
                                        @endforelse
                                                <div class="card mb-3">
                                                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                                                                {{ csrf_field() }}
                                                                <input type="text" name="body" class="w-full border-grey py-4" style="background-color: #fff;outline-color:#ddd" placeholder="add Task "/>
                                                        </form>
                                                </div>
                                        
                                        
                                </div>

                                <div class="mb-4">

                                        <h2 style="color: rgba(0, 0, 0, 0.4)" class="text-lg mb-3">General Notes</h2>
                                        <form action="{{ $project->path() }}" method="POST">
                                                {{ method_field('PATCH') }}
                                                {{ csrf_field() }}
                                                <textarea 
                                                        name="notes" 
                                                        placeholder="you can add your notes here ... !" 
                                                        class="card w-full" 
                                                        style="min-height: 200px">{{ $project->notes }}
                                                </textarea>
                                                <input type="submit" class="btn" value="Save">

                                                @if ($errors->any())
          
                                                <div class="field mt-6">
                                                        @foreach ($errors->all() as $error)
                                                                <li class="text-small text-red" style="color: red">{{ $error }}</li>
                                                        @endforeach
                                                </div>
                                        @endif

                                        </form>
                                </div>
                        </div>
                        
                        <div class="lg:w-1/4 px-3">

                                @include('projects.card')

                        </div>
                </div>
        </main>

@endsection
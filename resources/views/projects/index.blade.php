
@extends('layouts.app')
@section('content')

    <header class="flex items-center mb-3">

        <div class="flex items-end justify-between w-full">

            <h2 style="color: rgba(0, 0, 0, 0.4)">Projects</h2>

            <a href="/projects/create" style="padding: 5px;border-radius:4px;color:#fff;background:#2da6ce">New Project</a>
        </div>
    </header>

    <main class="lg:flex lg:flex-wrap -mx-6">
        @forelse ($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">

                @include('projects.card')

            </div>
        @empty
            <li>No project yet !</li>
        @endforelse
    </main>
    <ul>
    </ul>
@endsection

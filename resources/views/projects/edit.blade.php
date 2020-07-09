
@extends('layouts.app')
@section('content')
<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
<h1 class="text-center">Edit Project</h1>
  <div class="w-full mx-auto max-w-md">
      <form class="" action="{{ $project->path() }}" method="POST">
          {{ csrf_field()  }}
          {{ method_field('PATCH') }}
          {{-- <h2 class="flex mx-auto"></h2> --}}
              
            @include('projects._form',['button'=>'Update Project'])
  
      </form>
      @if ($errors->any())
          
        <div class="field mt-6">
        
          @foreach ($errors->all() as $error)
  
            <li class="text-small text-red" style="color: red">{{ $error }}</li>
            
          @endforeach
        
        </div>
    @endif
    </div>
</div>

  @if ($errors->any())
      
      <div class="field mt-6">
      
        @foreach ($errors as $error)

          <li class="text-small text-red">{{ $error }}</li>
          
        @endforeach
      
      </div>
  @endif
  
@endsection
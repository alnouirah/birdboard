
@extends('layouts.app')
@section('content')

<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
  <h1 class="text-center">Lets Begin Something New ... </h1>
    <div class="w-full mx-auto max-w-md">
        <form class="" action="/projects/" method="POST">
            {{ csrf_field()  }}
                
              @include('projects._form',['button' =>  'Create Project'])
    
        </form>
        
    @if ($errors->any())
          
        <div class="field mt-6">
        
          @foreach ($errors->all() as $error)
  
            <li class="text-small text-red" style="color: red">{{ $error }}</li>
            
          @endforeach
        
        </div>
    @endif
  
  @endsection


      </div>

</div>

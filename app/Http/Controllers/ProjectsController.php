<?php

namespace App\Http\Controllers;

use auth;
use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(){

        $projects = Project::all();

        return view('projects/index',compact('projects'));

    }

    public function show(){
        
        $porject = Project::find(request('project'));

        return view('projects/show',compact('porject'));
    }

    public function store(){

        $attributes = request()->validate([
                        'title'         => 'required',
                        'description'   =>  'required',
                    ]);


        auth()->user()->projects()->create($attributes);

        return redirect('/projects');

    }
}

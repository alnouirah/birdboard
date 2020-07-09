<?php

namespace App\Http\Controllers;

use auth;
use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(){

        $projects = auth()->user()->projects;

        return view('projects/index',compact('projects'));

    }

    public function create(){
        
        return view('projects/create',['project' => new \App\Project]);

    }

    public function show(){
        
        $project = Project::findOrFail(request('project'));

        $this->authorize('update',$project);

        return view('projects/show',compact('project'));
    }

    public function store(){

        $project = auth()->user()->projects()->create($this->validateRequest());

        return redirect($project->path());

    }

    public function update(Project $project){
        $this->authorize('update',$project);
        $project->update($this->validateRequest());
        return redirect($project->path());
    }

    public function edit(Project $project){
        return view('projects.edit',compact('project'));
    }

    private function validateRequest(){
            return  request()->validate([
                'title'         =>  'sometimes:required',
                'description'   =>  'sometimes:required',
                'notes'         =>  'nullable'
        ]);
    }
}

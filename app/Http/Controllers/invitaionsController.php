<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use Illuminate\Http\Request;

class invitaionsController extends Controller
{
    public function store(Project $project){
        
        request()->validate([
            'email'   =>  'exists:users,email'
        ]);

        $user = User::whereEmail(request('email'))->first();
        $project->invite($user);
    }
}

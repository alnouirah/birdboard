<?php

namespace App;

use App\Activity;
use Illuminate\Database\Eloquent\Model;
use PDO;
use App\recordActivity;

class Project extends Model
{
    use recordActivity;
    protected $guarded = [];

    public function path()
    {
        return "/projects/{$this->id}";
    }

    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    } 

    public function addTask($body){
        return $this->tasks()->create(['body'=> $body]);
    }

    public function activity(){
        return $this->hasMany('App\Activity')->latest();
    }

    public function invite(User $user){
        $this->members()->attach($user);
    }

    public function members(){
        return $this->belongsToMany(User::class,'project_members');
    }
}

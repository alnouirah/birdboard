<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\recordActivity;
class Task extends Model
{
    use recordActivity;
    //
    protected $guarded = [];
    protected $touches = ['project'];

    public static $recorderableEvents = ['created','deleted'];

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function path(){
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

    public function completed(){
        $this->update(['completed'=>true]);
        $this->recordActivity('task_completed');
    }
   
    public function incompleted(){
        $this->update(['completed'=>false]);
        $this->recordActivity('task_incompleted');
    }
}
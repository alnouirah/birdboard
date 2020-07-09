<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Task;
use App\Project;

class TasksTest extends TestCase
{
    use RefreshDatabase;
    /** @test **/
    
    public function a_task_have_a_project() {
    
     $this->withoutExceptionHandling(); 
    
     $task = factory(Task::class)->create();

     $this->assertInstanceOf(Project::class,$task->project);

    }
    
    /** @test **/
    
    public function tasks_have_a_path() {

        $this->withExceptionHandling();

        $task = factory(Task::class)->create();

        $this->assertEquals('/projects/'.$task->project->id.'/tasks/'.$task->id,$task->path());
    
    }
    
}

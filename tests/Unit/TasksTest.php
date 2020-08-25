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

    /** @test **/
    
    public function task_can_be_completed() {
    
        $this->withoutExceptionHandling();
        $task = Factory(Task::class)->create();
        $this->assertEquals(false,$task->completed);
        $task->completed();
        $this->assertEquals(true,$task->completed);
    }

    /** @test **/
    public function task_can_be_incompleted() {
    
        $this->withoutExceptionHandling();
        $task = Factory(Task::class)->create();
        $task->completed();
        $this->assertEquals(true,$task->completed);
        $task->incompleted();
        $this->assertEquals(false,$task->completed);
    }
    
    
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Arrangments\ProjectFactory;


class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;
    /** @test **/
    public function only_owner_of_project_can_add_tasks() {
        $this->signIn();
        $project = factory('App\Project')->create();
        $this->post($project->path() . '/tasks',['body' =>  'Test tasks'])->assertStatus(403);
        $this->assertDatabaseMissing('tasks',['body'   =>  'Test tasks']);
    }

    /** @test **/
    public function guests_cannot_add_task_to_projects() {
        $project = factory('App\Project')->create();
        $this->get($project->path())->assertRedirect('login');
    }

    /** @test **/
    public function a_project_can_have_a_task() {
        $project = ProjectFactory::withTasks(1)->create();
        $task = $this->actingAs($project->owner)->post($project->path() . '/tasks',['body' =>  'Test tasks']);
        $this->get($project->path())->assertSee('Test tasks');
    }

    /** @test **/ 
    public function a_task_require_a_body() {
        $project = ProjectFactory::create();
        $this->actingAs($project->owner)->post($project->path().'/tasks',['body'=>''])->assertSessionHasErrors('body');
    }

    /** @test **/
    public function a_tasks_can_be_updated() {
        $project = ProjectFactory::withTasks(1)->create();
        
        $this->actingAs($project->owner)->patch($project->tasks->first()->path(),[
            'body'          =>  'newBody',
            'completed'    =>  true
        ]);
        
        $this->assertDatabaseHas('tasks',[
            'body'          =>  'newBody',
            'completed'    =>  true
        ]);

    }
    
    /** @test **/
    public function a_tasks_can_be_completed() {
        $project = ProjectFactory::withTasks(1)->create();
        
        $this->actingAs($project->owner)->patch($project->tasks->first()->path(),[
            'body'          =>  'newBody',
            'completed'    =>  true
        ]);
        
        $this->assertDatabaseHas('tasks',[
            'body'          =>  'newBody',
            'completed'    =>  true
        ]);

    }

    /** @test **/
    public function a_tasks_can_be_incompleted() {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::withTasks(1)->create();
        
        $this->actingAs($project->owner)->patch($project->tasks->first()->path(),[
            'body'          =>  'newBody',
            'completed'    =>  true
        ]);
        
        $this->assertDatabaseHas('tasks',[
            'body'          =>  'newBody',
            'completed'    =>  true
        ]);

        $this->actingAs($project->owner)->patch($project->tasks->first()->path(),[
            'body'          =>  'newBody',
            'completed'    =>  false
        ]);

        $this->assertDatabaseHas('tasks',[
            'body'          =>  'newBody',
            'completed'    =>  false
        ]);
    }

    /** @test **/
    public function only_project_owner_can_update_a_task() {
        $project = ProjectFactory::withTasks(1)->create();
        $this->patch($project->tasks->first()->path(),['body'=>'new body','completed'=>true]);
        $this->assertDatabaseMissing('tasks',[
            'body'          =>  'new body',
            'completed'    =>  true,
        ]);
    }
}

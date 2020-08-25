<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Arrangments\ProjectFactory;

class ManageProjectsTests extends TestCase
{
    use WithFaker , RefreshDatabase;


    /** @test **/
    public function guestes_cannot_manage_projects() {
        $project = factory("App\Project")->create();
        $this->post('/projects',$project->toArray())->assertRedirect('login');
        $this->get('/projects')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
    }

    /** @test **/    
    public function an_authenticated_user_cannot_view_projects_of_other() {
        $this->signIn();
        $project = factory('App\Project')->create();
        $this->get($project->path())->assertStatus(403);
    }
    
    /** @test */
    public function a_user_can_make_project(){
        $this->signIn();
        $attributes = [
            'title'         => $this->faker->sentence,
            'description'   => $this->faker->sentence,
            'notes'         => "this is new note"
        ];
        $this->get('/projects/create')->assertStatus(200);
        $response = $this->post('/projects',$attributes);
        $project = Project::where($attributes)->first();
        $response->assertRedirect($project->path());
        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    /** @test */
    public function a_user_can_delete_project(){
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $this->actingAs($project->owner)->delete($project->path())->assertRedirect('/projects');
        $this->assertDatabaseMissing('projects',$project->only('id'));
    }
    
    /** @test */
    public function a_user_can_update_project(){

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->patch($project->path(),$attributes = ['title'=>'new title','description'=>'new','notes'=>'changed'])->assertRedirect($project->path());

        $this->assertDatabaseHas('projects',$attributes);
    }

    /** @test **/
    public function a_user_can_update_project_notes() {
        $this->withoutExceptionHandling(); 
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->patch($project->path(),$attributes = ['notes'=>'change']);

        $this->assertDatabaseHas('projects',$attributes);
    }

     /** @test **/
     public function an_authenticated_user_cannot_update_projects_of_other() {
        $this->signIn();
        $project = factory('App\Project')->create();
        $this->patch($project->path())->assertStatus(403);
    }

    /** @test **/
    
    public function an_authenticated_user_can_only_see_there_projects_or_projectes_inveted_to_by_others() {
        $project = tap(ProjectFactory::create())->invite($this->signIn());
        $this->get('/projects')->assertSee($project->title);
    }
    

    /** @test **/
     public function an_authenticated_user_cannot_delete_projects_of_other() {
        $project = factory('App\Project')->create();
        $this->delete($project->path())->assertRedirect('/login');
        $this->signIn();
        $this->delete($project->path())->assertStatus(403);
    }

    /** @test */
    public function a_user_can_view_his_project(){
        $project = ProjectFactory::create();
        $this->actingAs($project->owner)->get($project->path())
             ->assertSee($project->title)
             ->assertSee($project->description);
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTests extends TestCase
{
    use WithFaker , RefreshDatabase;


    /** @test **/
    
    public function only_authenticated_user_can_create_projects() {

        $attributes = factory("App\Project")->raw();

        $this->post('/projects',$attributes)->assertRedirect('login');
    
    }


    /** @test */

    public function a_user_can_make_project(){

        $this->actingAs(Factory('App\User')->create());

        $this->withoutExceptionHandling();

        $attributes = [

            'title' =>  $this->faker->sentence,
            'description'   => $this->faker->paragraph
        ];

        $this->post('/projects',$attributes)->assertRedirect('/projects');
        
        $this->assertDatabaseHas('projects',$attributes);

        $this->get('/projects')->assertSee($attributes['title']);

    }

    /** @test */

    public function a_project_can_be_viewd(){

        $this->actingAs(Factory('App\User')->create());

        $this->withoutExceptionHandling();

        $project = Factory('App\Project')->create();

        $this->get($project->path())
             ->assertSee($project->title)
             ->assertSee($project->description);
        

    }
    

    /** @test */

    public function title_is_required(){

        $this->actingAs(Factory('App\User')->create());

        $attributes = Factory("App\Project")->raw(['title'  =>   '']);

        $this->post('/projects',$attributes)->assertSessionHasErrors('title');

    }
    
    /** @test */

    public function description_is_required(){

        $this->actingAs(Factory('App\User')->create());

        $attributes = Factory("App\Project")->raw(['description'  =>   '']);

        $this->post('/projects',[])->assertSessionHasErrors('description');

    }


    
}

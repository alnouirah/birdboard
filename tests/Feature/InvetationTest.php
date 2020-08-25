<?php

namespace Tests\Feature;

use App\User;
use Carbon\Factory;
use Facades\Tests\Arrangments\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvetationTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    
    public function only_the_owner_of_project_can() {
    
     $this->withoutExceptionHandling(); 
    
    }
    
    /** @test **/
    public function an_envited_user_must_be_an_assocciated_birdboard_member() {
        $project = ProjectFactory::create();
        $this->actingAs($project->owner)->post($project->path().'/invitation',[
            'email' =>  'not@gmail.com'
        ])->assertSessionHasErrors('email');
    }
    
    /** @test **/
    public function a_user_can_be_envited_to_a_project() {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $userToInvite = Factory(User::class)->create();
        $this->actingAs($project->owner)->post($project->path().'/invitation',['email'=>$userToInvite->email]);
        $this->assertTrue($project->members->contains($userToInvite));
    
    }
    
    /** @test **/
    public function a_project_member_can_update_a_project() {
        $project = ProjectFactory::create();
        $project->invite($user =  Factory(User::class)->create());
        $this->actingAs($user)->post(action('ProjectTasksController@store',$project),$task = ['body'    =>  'hi there']);
        $this->assertDatabaseHas('tasks',$task);
    }
    
}

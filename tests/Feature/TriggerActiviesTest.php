<?php

namespace Tests\Feature;

use Facades\Tests\Arrangments\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Task;

class TriggerActiviesTest extends TestCase
{
   use RefreshDatabase;
   /** @test **/
   public function createing_project() {
   
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        
        $this->assertCount(1,$project->activity);
        tap($project->activity->last() , function($activity){
          $this->assertEquals('created_project',$activity->description);
          $this->assertNull($activity->changes);
        });
   
   }

   /** @test **/
   public function updating_a_project() {
   
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $originalTitle = $project->title;
        $project->update(['title'=>'new title']);
        tap($project->activity->last(), function($activity) use($originalTitle){
          $expected = [
               'before'   =>  ['title'  =>   $originalTitle],
               'after'   =>   ['title'  =>   'new title']
          ]; 
          $this->assertEquals($expected,$activity->changes); 
        });
   }

   /** @test **/
   public function creating_a_task() {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $project->addTask('some tasks');
        tap($project->activity->last(),function($activity){
             $this->assertEquals('created_task',$activity->description);
             $this->assertInstanceOf(Task::class,$activity->subject);
             $this->assertEquals('some tasks',$activity->subject->body);
        });
   }

   /** @test **/
   public function compleating_a_task() {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::withTasks(1)->create();
        $project->tasks->first()->completed();
        $this->assertCount(3,$project->activity);
   }
   
   /** @test **/
   public function incompleating_a_task() {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::withTasks(1)->create();
        $project->tasks->first()->completed();
        $this->assertCount(3,$project->activity);
        $project->tasks->first()->incompleted();
        $this->assertCount(4,$project->fresh()->activity);
   }

   /** @test **/
   public function deleting_a_task() {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::withTasks(1)->create();
        $project->tasks->first()->delete();
        $this->assertCount(3,$project->fresh()->activity);
   }
}

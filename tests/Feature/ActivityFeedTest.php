<?php

namespace Tests\Feature;

use Facades\Tests\Arrangments\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityFeedTest extends TestCase
{
   use RefreshDatabase;
   /** @test **/
   public function createing_project_generating_activity() {
   
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $this->assertCount(1,$project->activity);
        $this->assertEquals('created',$project->activity[0]->description);
   
   }

   /** @test **/
   public function updating_a_project_generating_activity() {
   
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $this->patch($project->path(),['title'=>'new title']);

        $this->assertCount(2,$project->activity);
        $this->assertEquals('updated',$project->activity->last()->description);
   
   }
   
}

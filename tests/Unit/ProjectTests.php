<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Activity;
use Facades\Tests\Arrangments\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTests extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path(){
        $project = Factory('App\Project')->create();
        $this->assertEquals('/projects/'.$project->id,$project->path());
    }

    /** @test */
    public function project_can_add_tasks(){
        $project = Factory('App\Project')->create();
        $task = $project->addTask('Test task');
        $this->assertCount(1,$project->tasks);
        $this->assertTrue($project->tasks->contains($task));
    }

}

<?php

namespace Tests\Unit;

use Facades\Tests\Arrangments\ProjectFactory;
use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_has_a_user() {
        $user = $this->signIn();
        $project = ProjectFactory::ownedBy($user)->create();
        $this->assertEquals($project->owner->id,$project->activity->last()->user->id);
    }
    
}

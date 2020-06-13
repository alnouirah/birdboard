<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class userTests extends TestCase
{

    use RefreshDatabase;

   /** @test **/
   
   public function a_user_can_access_projects() {
   
        $user = Factory('App\User')->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
   
   }
   
}

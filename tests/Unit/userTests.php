<?php

namespace Tests\Unit;

use App\User;
use Carbon\Factory;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Arrangments\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class userTests extends TestCase
{

    use RefreshDatabase;
   /** @test **/
   public function a_user_can_access_projects() {
        $user = Factory('App\User')->create();
        $this->assertInstanceOf(Collection::class, $user->projects);
   }

   /** @test **/
   public function a_user_has_acceccible_project() {
     $ammar = $this->signIn();
     ProjectFactory::ownedBy($ammar)->create();
     $this->assertCount(1,$ammar->accessibleProjects());
     $hassan = Factory(User::class)->create();
     $ali = Factory(User::class)->create();
     tap(ProjectFactory::ownedBy($ali)->create())->invite($hassan);
     $this->assertCount(1,$ammar->accessibleProjects());
 }
   
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
  use RefreshDatabase;
    /**
     * A user test example.
     *
     * @return void
     */

     /** @test */
     public function user_can_be_created()
     {
       $this->postJson('api/v1/users',
           ['firstname' => 'James','lastname'=>'jerry','isblocked'=>false])
           ->assertStatus(200);
         $this->assertDatabaseHas('users',['firstname'=>'James']);
   }

   /** @test */
   public function user_required_filed_not_be_null(){
     $this->postJson('api/v1/users',
         ['firstname'=>null,'isblocked'=>false])
         ->assertStatus(422);
   }

    /** @test */
   public function user_resource_can_be_viewed(){
       $user=User::factory()->create();
       $this->getJson($user->path())->assertSee($user->id)
       ->assertStatus(200);
   }

   /** @test */
   public function a_user_can_be_updated(){
      $user=User::factory()->create();
      $firstname="jerry";
      $this->withoutExceptionHandling()->patchJson($user->path(),['firstname'=>$firstname,
      'isblocked'=>$user->isblocked]);
      $this->assertDatabaseHas('users',['id'=>$user->id,'firstname'=>$firstname]);
   }

   /** @test */
   public function a_user_can_be_deleted(){
     $user=User::factory()->create();
     $this->assertCount(1,$user->get());
     $this->withoutExceptionHandling()->deleteJson($user->path())->assertStatus(200);
     $this->assertCount(0,$user->get());
  }







}

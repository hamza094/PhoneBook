<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Contact;
use Tests\TestCase;

class ContactTest extends TestCase
{
  use RefreshDatabase;
    /**
     * A contact test example.
     *
     * @return void
     */

     /** @test */
     public function contact_can_be_created()
     {
       $user=User::factory()->create();
       $this->postJson('api/v1/contacts',
           ['user_id'=>$user->id,'mobile' => '0947867895','type'=>'home'])
           ->assertStatus(200);
         $this->assertDatabaseHas('contacts',['mobile'=>'0947867895']);
   }

   /** @test */
   public function contact_required_filed_not_be_null(){
     $this->postJson('api/v1/contacts',
         ['mobile'=>null,'type'=>'home'])
         ->assertStatus(422);
   }


   /** @test */
   public function contact_resource_can_be_viewed(){
       $contact=Contact::factory()->create();
       $this->getJson($contact->path())->assertSee($contact->mobile)
       ->assertStatus(200);
   }

   /** @test */
   public function a_contact_can_be_updated(){
      $contact=Contact::factory()->create();
      $mobile='0947867895';
      $this->patchJson($contact->path(),['mobile'=>$mobile,
      'type'=>$contact->type,'user_id'=>$contact->user->id]);
      $this->assertDatabaseHas('contacts',['id'=>$contact->id,'mobile'=>$mobile]);
   }

  /** @test */
   public function a_contact_can_be_deleted(){
     $contact=Contact::factory()->create();
     $this->deleteJson($contact->path())->assertStatus(200);
     $this->assertDatabaseMissing('contacts',['id'=>$contact->id]);
  }

}

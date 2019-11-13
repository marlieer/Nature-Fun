<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    

    /** @test */
    public function a_family_can_register_multiple_children()
    {
        $this->withoutExceptionHandling();

        // given a user has multiple children to register in a session and the session is not full yet

        // when they check both the children to register in a session at /registration/create
        $this->post('/registration',[
            's_id'=>'345',
            'f_id'=>'7',
            '22'=>'22',
            '23'=>'23'
        ]);

        // then one registration instance will be made for each child
        $this->assertDatabaseHas('registration',['c_id'=>'22']);
        $this->assertDatabaseHas('registration',['c_id'=>'23']);
    }
}

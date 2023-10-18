<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test401UnauthorizedOnMe() {
        $response = $this->get('/');
        $response ->assertStatus( 401);
    }

    public function test_example(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');
        $response->assertOk();
    }






}

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetUserInfo()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/user');

        $response->assertStatus(200);
        $response->assertJson($user->toArray());
    }
}

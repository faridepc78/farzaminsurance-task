<?php

namespace Api\V1\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /* start tests for user login */

    public function test_user_can_login()
    {
        $user = $this->createUser();

        $data = [
            'email' => $user->email,
            'password' => '12345678'
        ];

        $this->postJson(route('api.v1.auth.login'), $data)
            ->assertSuccessful()
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'code',
                'data'
            ]);
    }

    public function test_user_can_not_login()
    {
        $user = $this->createUser();

        $data = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $this->postJson(route('api.v1.auth.login'), $data)
            ->assertStatus(401);
    }

    /* end tests for user login */


    /* start tests for user logout */

    public function test_user_can_logout()
    {
        $user = $this->createUser();

        $this->actingAs($user);

        $this->postJson(route('api.v1.auth.logout'))
            ->assertSuccessful()
            ->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'message',
                'code'
            ]);
    }

    public function test_user_can_not_logout()
    {
        $this->createUser();

        $this->postJson(route('api.v1.auth.logout'))
            ->assertStatus(401);
    }

    /* end tests for user logout */


    /* start helper functions */

    private function createUser()
    {
        return User::factory()->create();
    }

    /* end helper functions */
}

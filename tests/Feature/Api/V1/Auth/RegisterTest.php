<?php

namespace Api\V1\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;


    /* start tests for user register */

    public function test_user_can_not_register_because_username_is_required()
    {
        $this->postJson(route('api.v1.auth.register'), $this->userData())
            ->assertStatus(422);
    }

    public function test_user_can_not_register_because_password_is_required()
    {
        $this->postJson(route('api.v1.auth.register'), [
            'name' => 'test',
            'email' => 'test@gmail.com'
        ])->assertStatus(422);
    }

    public function test_user_can_not_register_because_password_and_confirm_is_required()
    {
        $this->postJson(route('api.v1.auth.register'), [
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => '12345678'
        ])->assertStatus(422);
    }

    public function test_user_can_register()
    {
        $this->postJson(route('api.v1.auth.register'),
            $this->userData() +
            [
                'name' => 'test',
                'email' => 'test@gmail.com'
            ])
            ->assertSuccessful()
            ->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'code'
            ]);

        $this->assertEquals(1, User::count());
    }

    /* end tests for user register */

    /* start helper functions */

    private function userData(): array
    {
        return [
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ];
    }

    /* end helper functions */
}

<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * user_can_not_register_without_handle_or_email
     * @test
     * @group login
     * @return void
     */
    public function user_can_not_register_without_handle_or_email()
    {
        $this->post('/login')
            ->assertStatus(422)
            ->assertJson([
                "errors" => [
                    'login' => ['The handle or email field is requried.'],
                ],
            ]);
    }

    /**
     * user_can_not_register_without_password
     * @test
     * @group login
     * @return void
     */
    public function user_can_not_register_without_password()
    {
        $this->post('/login')
            ->assertStatus(422)
            ->assertJson([
                "errors" => [
                    'password' => ['The password field is required.'],
                ],
            ]);
    }

    public function user_can_not_login_with_wrong_handle()
    {

    }

    /**
     * test_loginArray
     * @group login
     * @return void
     */
    public function test_loginArray()
    {
        $user = $this->createUser();

        //dd(User::all());
        // dd($user);
        $this->post('/login', [
            'login' => $user['handle'] . "",
            'password' => $user['password'],
        ])
            ->assertStatus(200)
            ->assertJson([
                "message" => "Login is not correct",
            ]);
        // $response = (new AuthService())->login([
        //     'login' => $user['handle'],
        //     'password' => "123456",
        // ]);
    }

    public function createUser()
    {
        $user = [
            'handle' => 'hamza',
            'name' => 'sk.amirhamza',
            'email' => 'sk.amirhamza@gmail.com',
            'password' => '123456',
        ];
        User::create($user);
        return $user;
    }

}

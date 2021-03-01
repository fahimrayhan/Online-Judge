<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * User can not login without handle or email
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
     * User can not login without password
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

    /**
     * User can not login using wrong handle or email
     * @test
     * @group login
     * @return void
     */
    public function user_can_not_login_with_wrong_handle()
    {
        $user = $this->createUser();
        $this->post('/login', [
            'login' => 'ge',
            'password' => $user['password'],
        ])
            ->assertStatus(401)
            ->assertJson([
                "message" => "Login information is not correct.",
            ]);
    }

    /**
     * User can not login using wrong password although handle or email is correct
     * @test
     * @group login
     * @return void
     */
    public function user_can_not_login_with_wrong_password()
    {
        $user = $this->createUser();
        $this->post('/login', [
            'login' => $user['handle'],
            'password' => "874854",
        ])
            ->assertStatus(401)
            ->assertJson([
                "message" => "Login information is not correct.",
            ]);
    }

    /**
     * User can login using valid handle and password
     * @test
     * @group login
     * @return void
     */
    public function successfully_login_using_handle()
    {
        $user = $this->createUser();
        $this->post('/login', [
            'login' => $user['handle'],
            'password' => $user['password'],
        ])
            ->assertStatus(200)
            ->assertJson([
                "message" => "Successfully Login.",
            ]);
    }

    /**
     * User can login using valid email and password
     * @test
     * @group login
     * @return void
     */
    public function successfully_login_using_email()
    {
        $user = $this->createUser();
        $this->post('/login', [
            'login' => $user['email'],
            'password' => $user['password'],
        ])
            ->assertStatus(200)
            ->assertJson([
                "message" => "Successfully Login.",
            ]);
    }
    
    /**
     * check_login_user_data_is_valid
     * @test
     * @group login
     * @return void
     */
    public function check_login_user_data_is_valid()
    {
        $user = $this->createUser();
        $this->post('/login', [
            'login' => $user['email'],
            'password' => $user['password'],
        ]);
        $this->assertEquals($user['handle'], auth()->user()->handle);
    }

    /**
     * Create single user
     *
     * @return array
     */
    public function createUser(): array
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

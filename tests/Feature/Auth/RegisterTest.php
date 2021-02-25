<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function postRoute()
    {
        return route('register');
    }

    /**
     * Chek register request path is valid
     * @test
     * @group register
     * @return void
     */
    public function check_register_path()
    {
        $this->post($this->postRoute())
            ->assertStatus(422);
    }

    /**
     * User can not register without fill requried field
     * Requried field are (handle,name,email,password)
     * @test
     * @group register
     * @return void
     */
    public function user_can_not_login_without_fill_requried_field()
    {

        $this->post($this->postRoute())
            ->assertStatus(422)
            ->assertJson([
                "errors" => [
                    'handle' => ['The handle field is required.'],
                    'name' => ['The name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ],
            ]);
    }

    /**
     * User can not register when handle length is less then min length
     * Limit handle min length is 3
     * @test
     * @group register
     * @return void
     */
    public function user_can_not_register_when_handle_length_less_then_min_length()
    {
        $handles = [
            'a',
            'ha',
            '4s',
            '!',
            '1s',
            Str::random(1),
        ];

        foreach ($handles as $key => $handle) {
            $this->post($this->postRoute(), ['handle' => $handle])
                ->assertStatus(422)
                ->assertJson([
                    "errors" => [
                        'handle' => ["The handle must be at least 3 characters."],
                    ],
                ]);
        }
    }

    /**
     * User can not register when handle length is greater then max length
     * Limit of handle max length is 20
     * @test
     * @group register
     * @return void
     */
    public function user_can_not_register_when_handle_length_greater_then_max_length()
    {
        $handles = [
            "abcdefghijklmnopabcdefghijklmnopabcdefghijklmnop",
        ];
        for ($i = 21; $i <= 50; $i++) {
            array_push($handles, Str::random($i));
        }

        foreach ($handles as $key => $handle) {
            $this->post($this->postRoute(), ['handle' => $handle])
                ->assertStatus(422)
                ->assertJson([
                    "errors" => [
                        'handle' => ["The handle may not be greater than 20 characters."],
                    ],
                ]);
        }
    }

    /**
     * User can not register when user handle is wrong format
     * Handle only support (a-zA-Z_0-9)
     * @test
     * @group register
     * @return void
     */
    public function user_can_not_register_when_handle_is_invalid_format()
    {
        $handles = [
            'abc-def',
            'abd ham',
            'abd 1 14',
            'ok ddde!',
            'dd ok dd 1111111',
        ];

        foreach ($handles as $key => $handle) {
            $this->post($this->postRoute(), ['handle' => $handle])
                ->assertStatus(422)
                ->assertJson([
                    "errors" => [
                        'handle' => [
                            "The handle format is invalid.",
                        ],
                    ],
                ]);
        }
    }

    /**
     * User can not register if email is already taken
     * @test
     * @group register
     * @return void
     */
    public function user_can_not_register_when_handle_is_already_taken()
    {
        $user = [
            'handle' => 'hamza',
            'name' => 'sk.amirhamza',
            'email' => 'sk.amirhamza@gmail.com',
            'password' => '123456',
        ];

        $this->post($this->postRoute(), $user)
            ->assertStatus(200)
            ->assertJson([]);

        $this->post($this->postRoute(), $user)
            ->assertStatus(422)
            ->assertJson([
                "errors" => [
                    'handle' => [
                        "The handle has already been taken.",
                    ],
                    'email' => [
                        "The email has already been taken.",
                    ],
                ],
            ]);
    }
    
    /**
     * User successfully created
     * @test
     * @group register
     * @return void
     */
    public function user_create_success()
    {
        $user = [
            'handle' => 'hamza',
            'name' => 'sk.amirhamza',
            'email' => 'sk.amirhamza@gmail.com',
            'password' => '123456',
        ];

        $this->post($this->postRoute(), $user)
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Account Successfully Created'
            ]);
    }

}

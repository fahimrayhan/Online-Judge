<?php

namespace Tests\Feature\Auth;

use Illuminate\Support\Str;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function Example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * check_register_path
     *
     *
     * @return void
     */
    public function check_register_path()
    {
        $this->post(route('register'))
            ->assertStatus(200);
    }

    
    /**
     * Check invalid handle
     * Handle is must required
     * Handle only support (a-zA-Z_0-9)
     * Handle length must be between 3-20
     * @test
     * @group register
     * @return void
     */
    public function user_can_not_register_when_handle_is_invalid()
    {
        $invalidHandleList = [
            'required' => [
                'message' => ['The handle field is required.'],
                'handles' => [''],
            ],
            'min' => [
                'message' => ['The handle must be at least 3 characters.'],
                'handles' => [
                    'a',
                    'ha',
                    '4s',
                    '!',
                    '1s',
                ],
            ],
            'max' => [
                'message' => ['The handle may not be greater than 20 characters.'],
                'handles' => [
                    Str::random(21),
                    Str::random(22),
                    Str::random(30),
                ],
            ],
            'regex' => [
                'message' => ['The handle format is invalid.'],
                'handles' => [
                    'abc-def',
                    'abd ham',
                    'abd 1 14',
                    'ok ddde!',
                    'dd ok dd 1111111',
                ],
            ],
        ];
        foreach ($invalidHandleList as $key => $data) {
            foreach ($data['handles'] as $key => $value) {
                $this->json('POST', route('register'), ['handle' => $value], ['Accept' => 'application/json'])
                    ->assertStatus(422)
                    ->assertJson([
                        "errors" => [
                            'handle' => $data['message'],
                        ],
                    ]);
            }
        }
    }
}

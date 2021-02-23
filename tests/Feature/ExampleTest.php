<?php

namespace Tests\Feature;
use Tests\TestCase;

//use App\Services\Auth\Layout;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function BasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**  */
    public function quick()
    {
       return;
        $this->json('POST', '/register', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "0" => "The name field is required.",
                    "1" => "The handle field is required.",
                    "2" => "The email field is required.",
                    "3" => "The password field is required.",
                ],
            ]);
    }
    
    /**  */
    public function password_need()
    {
        $data = [
            'email' => 'sk.amirhamza@gmail.com',
        ];
        $this->json('POST', '/register', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "0" => "The name field is required.",
                    "2" => "The password field is required.",
                    "1" => "The handle field is required.",
                ],
            ]);
    }


    /**
     * save_success
     * 
     * @return void
     */
    public function save_success1()
    {
        $input = [
            'name' => 'amir hamza',
            'handle' => 'hamza1',
            'email' => "sk.amirhamza@gmail.com",
            'password' => 'sk',
        ];

        $this->json('POST', '/register', $input, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Account Successfully Created',
            ]);

    }
    
    /**
     * save_success
     * 
     * @return void
     */
    public function save_success()
    {
        $data = [
            'name' => 'amir hamza',
            'handle' => 'hamza1',
            'email' => "sk.amirhamza@gmail.com",
            'password' => 'sk',
        ];
        $this->json('POST', '/register', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'Account Successfully Created',
            ]);

    }
    
}

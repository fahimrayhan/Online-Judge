<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Services\Auth\AuthService;

class LoginTest extends TestCase
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

    

}

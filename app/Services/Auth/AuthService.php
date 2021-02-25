<?php
namespace App\Services\Auth;

use App\Models\User;

class AuthService
{
    /**
     * Create New User
     *
     * @param  mixed $data
     * @return void
     */
    public function createNewUser($data)
    {
        $data['password'] = bcrypt($data['password']);
        User::create($data);
    }
    
}


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
        //dd($data);
        $data = request()->all();
        $data['password'] = bcrypt($data['password']);
        $data['type'] = 'super_admin';
        User::create($data);
    }

}


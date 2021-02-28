<?php
namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * Create New User
     *
     * @param  array $data
     * @return void
     */
    public function createNewUser($data)
    {
        User::create($data);
    }
    
    /**
     * login
     *
     * @param  array $data
     * @return boolean
     */
    public function login($data)
    {
        $login = $data['login'];
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'handle';
        Auth::attempt([
            $field => $login,
            'password' => $data['password'],
        ]);
        return Auth::check();
    }
}

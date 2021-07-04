<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    /**
     * @var \App\Services\Auth\AuthService $authService
     */
    protected $authService;

    /**
     * RegisterController constructor
     *
     * @param  \App\Services\Auth\AuthService $authSrvc
     * @return void
     */
    public function __construct(AuthService $authSrvc)
    {
        $this->authService = $authSrvc;
    }

    /**
     * Show the CoderOJ Register Form to the User.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view("pages.auth.register");
    }

    /**
     * Create a new user.
     *
     * @param  \App\Http\Requests\Auth\RegisterRequest $requset
     * @return void
     */
    public function register(RegisterRequest $requset)
    {
        $user = $this->authService->createNewUser($requset->all());
        return response()->json([
            'message' => 'Account Successfully Created'
        ]);
    }
}

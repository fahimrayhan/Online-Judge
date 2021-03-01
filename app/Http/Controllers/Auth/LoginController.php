<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;

class LoginController extends Controller
{
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
        return view("pages.auth.login");
    }

    /**
     * Login user.
     *
     * @param  \App\Http\Requests\Auth\RegisterRequest $requset
     * @return void
     */
    public function login(LoginRequest $requset)
    {
        $success = $this->authService->login($requset->all());
        if ($success) {
            return response()->json([
                'message' => 'Successfully Login.',
            ]);
        }
        return response()->json([
            'message' => 'Login information is not correct.',
        ],401);
    }
}

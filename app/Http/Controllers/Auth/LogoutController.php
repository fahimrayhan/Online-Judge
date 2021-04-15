<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{    
    /**
     * Logout if user logged in
     *
     * @return void
     */
    public function logout()
    {
        if (!Auth::check()) {
            abort(401, "You are not logged in.");
        }
        Auth::logout();
    }
}

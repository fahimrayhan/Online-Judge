<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function settings()
    {
        return redirect()->route('settings.profile');
    }
    public function profile()
    {
        return view('pages.settings.info');
    }
    public function changePassword()
    {
        return view('pages.settings.change_password');
    }
    public function changeName()
    {
        return view('pages.settings.change_name');
    }
}

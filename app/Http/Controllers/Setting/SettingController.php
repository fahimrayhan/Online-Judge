<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function generalSettings()
    {
        return view('pages.settings.info');
    }
    public function profile()
    {
        return view('pages.settings.info');
    }
    public function changePassword()
    {
        return view('pages.settings.change_password');
    }
    public function changeAvatar()
    {
        return view('pages.settings.change_avatar');
    }
}

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
}

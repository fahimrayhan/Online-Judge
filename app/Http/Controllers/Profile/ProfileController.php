<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function show($handle){
        $user = User::where(['handle' => $handle])->firstOrFail();

        return view("pages.profile.profile",[
            'user' => $user
        ]);
    }

    public function info(){
    	return view("pages.profile.sub.info",[
            'user' => $user
        ]);
    }

    public function home(){
    	return view("pages.home");
    	echo "string #hey bangladesh office printer";
    }
}

<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(){
        return view("pages.profile.profile");
    }

    public function info(){
    	return view("pages.profile.sub.info");
    }

    public function home(){
    	return view("pages.home");
    	echo "string #hey bangladesh office printer";
    }
}

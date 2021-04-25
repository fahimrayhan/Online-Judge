<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ChangePasswordRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Requests\Profile\ChangeAvatarRequest;
use App\Models\User;
use App\Services\Profile\ProfileService;
use Illuminate\Support\Facades\Storage;
use Hash;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

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

    public function updatePassword(ChangePasswordRequest $request)
    {
        $response = $this->profileService->changePassword($request->all());
        return response()->json([
            'message' => $response['message'],
        ],$response['status']);        
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $this->profileService->updateProfile($request->all());
        return response()->json([
            'message' => "Profile Updated Successfully",
        ]);

    }

    public function updateAvatar(ChangeAvatarRequest $request)
    {
        $this->profileService->changeAvatar($request);
        return response()->json([
            'message' => "Avatar Changed Successfully",
        ]);
    }
   
}

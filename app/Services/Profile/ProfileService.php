<?php
namespace App\Services\Profile;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Hash;
class ProfileService
{
    /**
     * Change Password
     *
     * @param  array $data
     * @return boolean
     */
    public function changePassword($data)
    {
        
        $user = auth()->user();
        if($data['old_password'] == $data['new_password'])
        {
            return [
                'message' => "Old password and new password must be different",
                'status' => 419
            ];
        }
         
        if(Hash::check($data['old_password'], $user->password))
        {
            $user->password = bcrypt($data['new_password']);
            $user->save();
            return [
                'message' => "Your Password Is Changed",
                'status' => 200
            ];
        }
        return [
            'message' => "Your old password do not match with current password",
            'status' => 419
        ];
    }

    public function updateProfile($data)
    {
        $user = auth()->user();
        $user->name = $data['name'];
        $user->save();
    }
    public function changeAvatar($data)
    {
        $user = auth()->user();
        $baseName = basename($user->avatar);
        if ($baseName != "default_avatar.png")
        {
            unlink(public_path('upload/avatars/').$baseName);
        }
        $avatar = $data->avatar;
        $fileName = hash('sha256',auth()->user()->handle .'-'.Str::random(20). "-" . time()).".".$avatar->extension();
        $avatar->move(public_path('upload/avatars'),$fileName);   
        $user->avatar = $fileName;
        $user->save();
    }
    
}

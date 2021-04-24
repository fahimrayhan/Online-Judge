<?php
namespace App\Services\Profile;

use App\Models\User;
use Hash;
class ProfileService
{
    /**
     * Change Password
     *
     * @param  array $data
     * @return boolean
     */
    public function ChangePassword($data)
    {
        
        $user = auth()->user();
        if($data['old_password'] == $data['new_password']) return ["Old password and new password must be different",1];
        if(Hash::check($data['old_password'], $user->password))
        {
            $user->password = bcrypt($data['new_password']);
            $user->save();
            return ["Your Password Is Changed",0];
        }
        return ["Your old password do not match with current password",1];
    }
    
}

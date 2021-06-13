<?php

namespace App\Services\User;

use App\Models\User;
use App\Models\ModeratorRequest;

class ModeratorService
{
    public function getAllModeratorList()
    {
        return User::where('type',30)->get();
    }

    public function getAllModeratorRequests()
    {
        return User::has('moderatorRequest')->get();
    }

    public function aproveModeratorRequest($userId)
    {
        $user = User::find($userId);
        $user->type = 30;
        $user->save();
        $user->moderatorRequest->delete();
    }

    public function deleteModeratorRequest($userId)
    {
        $user = User::find($userId);
        $user->moderatorRequest->delete();
    }

    public function deleteModerator($userId)
    {
        $user = User::find($userId);
        $user->type = 40;
        $user->save();
    }

}

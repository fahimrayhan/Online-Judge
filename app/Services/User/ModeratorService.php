<?php

namespace App\Services\User;

use App\Models\User;
use App\Models\ModeratorRequest;

class ModeratorService
{
    public function getRequestData($requestId)
    {
        return ModeratorRequest::findOrFail($requestId);
    }

    public function getAllModeratorList()
    {
        return User::where('type',30)->get();
    }

    public function getAllModeratorRequests()
    {
        return User::has('moderatorRequest')->get();
    }

    public function aproveModeratorRequest(ModeratorRequest $requestData)
    {
        
        $user = $requestData->user;
        $user->type = 30;
        $user->save();
        $requestData->delete();
    }

    public function deleteModeratorRequest(ModeratorRequest $requestData)
    {
        $requestData->delete();
    }

    public function deleteModerator($userId)
    {
        $user = User::find($userId);
        $user->type = 40;
        $user->save();
    }

}

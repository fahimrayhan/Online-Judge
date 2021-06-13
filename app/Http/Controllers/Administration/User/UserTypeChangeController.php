<?php

namespace App\Http\Controllers\Administration\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\ModeratorService;


class UserTypeChangeController extends Controller
{
    protected $moderatorService;
    public function __construct(ModeratorService $moderatorService)
    {
        $this->moderatorService  = $moderatorService;
    }

    public function modertators()
    {
        return view('pages.administration.settings.moderator_request.moderators',[
            'moderators' => $this->moderatorService->getAllModeratorList()
        ]);
    }
    public function modertatorRequests()
    {
        return view('pages.administration.settings.moderator_request.requests',[
            'users' => $this->moderatorService->getAllModeratorRequests()
        ]);
    }

    public function aproveModertatorRequest()
    {
        $this->moderatorService->aproveModeratorRequest(request()->userId);
        return response()->json([
            'message' => "Moderator Is Aproved"
        ]);
    }

    public function deleteModertatorRequest()
    {
        $this->moderatorService->deleteModeratorRequest(request()->userId);
        return response()->json([
            'message' => "Moderator Request is Deleted"
        ]);
    }

    public function deleteModertator()
    {
        $this->moderatorService->deleteModerator(request()->userId);
        return response()->json([
            'message' => "Modertar Become a Member"
        ]);
    }

    
}

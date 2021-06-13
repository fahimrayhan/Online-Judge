<?php

namespace App\Http\Controllers\Administration\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\ModeratorService;
use App\Models\ModeratorRequest;


class UserTypeChangeController extends Controller
{
    protected $moderatorService;
    protected $requestData;
    public function __construct(ModeratorService $moderatorService)
    {
        $this->moderatorService  = $moderatorService;
        if(isset(request()->requestId))
        {
            $this->requestData = $this->moderatorService->getRequestData(request()->requestId);
        }
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
        $this->moderatorService->aproveModeratorRequest($this->requestData);
        return response()->json([
            'message' => "Moderator Is Aproved"
        ]);
    }

    public function deleteModertatorRequest()
    {
        $this->moderatorService->deleteModeratorRequest($this->requestData);
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

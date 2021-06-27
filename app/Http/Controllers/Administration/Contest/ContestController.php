<?php

namespace App\Http\Controllers\Administration\Contest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contest\ContestUpdateRequest;
use App\Http\Requests\Contest\GenerateContestUserRequest;
use App\Models\Contest;
use App\Models\User;
use App\Services\Contest\ContestService;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    protected $contest;
    protected $contestService;
    public function __construct(ContestService $contestService)
    {
        $this->contestService = $contestService;
        if (isset(request()->contest_id)) {
            $this->contest = Contest::where(['id' => request()->contest_id])->firstOrFail();
        }
    }
    public function contestList()
    {
        $contests = auth()->user()->contests()->paginate(15);
        return view("pages.contest.dashboard.contest_list", ['contests' => $contests]);
    }

    public function overview()
    {
        return view('pages.administration.contest.overview.overview', ['contest' => $this->contest]);
    }

    public function edit()
    {
        return view('pages.administration.contest.edit.edit', ['contest' => $this->contest]);
    }

    public function update(ContestUpdateRequest $request)
    {
        $this->contestService->updateContest($this->contest, $request);
        return response()->json([
            'message' => "Contest Data Updated Successfully",
        ]);
    }

    public function problems()
    {
        return view('pages.administration.contest.problem.problem_list', ['problems' => $this->contest->problems]);
    }
    public function addProblem(Request $request)
    {
        return response()->json([
            'message' => $this->contestService->addProblem($this->contest, $request->slug),
        ]);
    }
    public function removeProblem(Request $request)
    {
        return response()->json([
            'message' => $this->contestService->removeProblem($this->contest, request()->problem_id),
        ]);
    }

    public function registrationList()
    {
        $tableColumn = $this->contestService->getDatatableColumn();
        return view('pages.administration.contest.registration.registration', [
            'tableColumn'     => $tableColumn,
            'tableColumnJson' => json_encode($tableColumn),
        ]);
    }

    public function datatableApi()
    {
        return $this->contestService->getDatatableData($this->contest);
    }

    public function viewGenerateTempUser()
    {
        return view('pages.administration.contest.registration.create_temp_user');
    }

    public function GenerateTempUser(GenerateContestUserRequest $request)
    {
        $path    = request()->file('data_file')->getRealPath();
        $csvData = array_map('str_getcsv', file($path));

        $response = $this->contestService->generateTempUser($this->contest, [
            'handlePrefix'   => $request->handle_prefix,
            'passwordLength' => $request->password_length,
            'csvData'        => $csvData,
        ]);

        return $response;
    }

    public function updateRegistrationStatus()
    {
        $userList = request()->user_list;

        $data = [];

        if (request()->status == "Delete") {
            $this->contest->registrations()->detach($userList);
        } else {
            foreach ($userList as $key => $value) {
                $data[$value] = [
                    'is_registration_accepted' => request()->status == "Accepted" ? 1 : 0,
                ];
            }
            $this->contest->registrations()->syncWithoutDetaching($data);
        }

        $this->contest->registrationCacheData()->save();

        $total  = count($userList);
        $status = request()->status;
        return response()->json([
            'message' => "Successfully {$status} {$total} Registrations",
        ]);
    }
}

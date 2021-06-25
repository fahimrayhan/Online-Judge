<?php

namespace App\Http\Controllers\Administration\Contest;

use App\Http\Controllers\Controller;
use App\Models\Contest;
use App\Http\Requests\Contest\ContestUpdateRequest;
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
            'message' => "Contest Data Updated Successfully"
        ]);
    }

    public function problems()
    {
        return view('pages.administration.contest.problem.problem_list', ['problems' => $this->contest->problems]);
    }
    public function addProblem(Request $request)
    {
        return response()->json([
            'message' => $this->contestService->addProblem($this->contest, $request->slug)
        ]);
    }
    public function removeProblem(Request $request)
    {
        return response()->json([
            'message' => $this->contestService->removeProblem($this->contest, request()->problem_id)
        ]);
    }
}

<?php

namespace App\Http\Controllers\JudgeProblem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\JudgeProblem\JudgeProblemService;
use App\Services\Problem\ProblemService;

class JudgeProblemController extends Controller
{
	protected $judgeProblemSerivce;
	protected $problemService;
	protected $problem;

	/**
     * JudgeProblem constructor
     *
     */
    public function __construct(ProblemService $probServc, JudgeProblemService $judgeProblemSerivce)
    {
        $this->problemService  = $probServc;
        $this->judgeProblemSerivce = $judgeProblemSerivce;
        if (isset(request()->slug)) {
            $this->problem = $this->problemService->getProblemData(request()->slug);
        }
    }
    /**
     * Request For Judge Problem
     */

    public function requestJudgeProblem()
    {
        $this->judgeProblemSerivce->requestForJudgeProblem($this->problem);
        return response()->json([
            'message' => "Your Request Waiting For Acceptance"
        ]);
    }
    

    /**
     * Show all judge Problems
     */
    public function judgeProblems()
    {
        // dd($this->judgeProblemSerivce->getAllJudgeProblems());
        return view('pages.administration.settings.judge_problem.judge_problems', [
            'problems' => $this->judgeProblemSerivce->getAllJudgeProblems()
        ]);
    }

    /**
     * Aprove Request For Judge Problem
     */
    public function aproveRequest()
    {
        $this->judgeProblemSerivce->acceptJudgeProblem(request()->judge_problem_id);
        return response()->json([
            'message' => "One Problem Is accepted for judge problem"
        ]);
    }

    /**
     * Delete From Judge Problem
     */

    public function deleteFromJudgeProblem()
    {
        $this->judgeProblemSerivce->deleteFromJudgeProblem(request()->judge_problem_id);
        return response()->json([
            'message' => "Problem is deleted from judge problem"
        ]);
    }
}

<?php

namespace App\Http\Controllers\Problem;

use App\Http\Controllers\Controller;
use App\Models\JudgeProblem;
use App\Models\Problem;
use App\Models\Submission;
use Illuminate\Http\Request;

class ProblemListController extends Controller
{
    public function show()
    {
        $JudgeProblems = JudgeProblem::where(['is_accepted' => true])->orderBy('problem_id', 'ASC')->paginate(15);
        return view("pages.problem.list.problem_list", ['JudgeProblems' => $JudgeProblems]);
    }

    public function viewProblem()
    {
        $problem = Problem::where(['slug' => request()->slug])->firstOrFail();
        $lastSubmissionList = [];
        if(auth()->check()){
            $lastSubmissionList = Submission::where(['type' => 2,'problem_id' => $problem->id,'user_id' => auth()->user()->id])->orderBy('id','desc')->limit(5)->get(); 
        }

        return view("pages.problem.view_problem", [
            'problem' => $problem,
            'lastSubmissionList' => $lastSubmissionList
        ]);
    }
}

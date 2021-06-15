<?php

namespace App\Http\Controllers\Problem;

use App\Http\Controllers\Controller;
use App\Models\JudgeProblem;
use App\Models\Problem;
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
        return view("pages.problem.view_problem", ['problem' => $problem]);
    }
}

<?php

namespace App\Services\JudgeProblem;

use App\Models\JudgeProblem;
use App\Models\Problem;

class JudgeProblemService
{
    public function requestForJudgeProblem(Problem $problem)
    {
        JudgeProblem::create([
            'problem_id' => $problem->id,
            'user_id' => auth()->user()->id
        ]);
    }

    public function getAllPendingRequests()
    {
        return JudgeProblem::where('is_accepted', false)->get();
    }

    public function getAllJudgeProblems()
    {
        return Problem::has('judgeProblem')->get();
    }

    public function acceptJudgeProblem($judgeProblemId)
    {
        $judgeProblem = JudgeProblem::findOrFail($judgeProblemId);
        $judgeProblem->is_accepted = true;
        $judgeProblem->save();
    }

    public function deleteFromJudgeProblem($judgeProblemId)
    {
        $judgeProblem = JudgeProblem::findOrFail($judgeProblemId);
        $judgeProblem->delete();
    }
}

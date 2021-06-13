<?php

namespace App\Http\Controllers\Problem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Problem;

use App\Services\Layout\Layout;

class ProblemListController extends Controller
{
    public function show(){
    	$problems = Problem::orderBy('id', 'DESC')->paginate(15);
    	return view("pages.problem.list.problem_list",['problems' => $problems]);
    }
    public function viewProblem(){
    	$problem = Problem::where(['slug' => request()->slug])->firstOrFail();
    	return view("pages.problem.view_problem",['problem' => $problem]);
    }
}

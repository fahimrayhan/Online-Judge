<?php

namespace App\Http\Controllers\Problem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Models\Problem;

class ProblemDashboardController extends Controller
{
    public function show(){
    	$problems = auth()->user()->problems()->paginate(15);
    	return view("pages.problem.dashboard.problems_list",['problems' => $problems]);
    }
}

<?php

namespace App\Http\Controllers\Problem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Layout\Layout;

class ProblemListController extends Controller
{
    public function show(){
    	return view("pages.problem.list.problem_list");
    }
}

<?php

namespace App\Http\Controllers\TestCase;

use App\Http\Controllers\Controller;
use App\Models\ProblemTestCase;
use App\Models\Problem;

class TestCaseController extends Controller
{
    public function addTestCase()
    {
    	ProblemTestCase::where(['id' => 1])->get();
    	$problem = Problem::where(['slug' => request()->slug])->firstOrFail();

    	dd(request()->all());

    	return;

    	$testCase = ProblemTestCase::create([
    		'problem_id' => $problem->id,
    		'point' => rand()%15
    	]);

    	dd($problem->testCases()->get());
    }

    public function deleteTestCase(){

    }
}
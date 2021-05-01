<?php

namespace App\Http\Controllers\TestCase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Problem\TestCaseRequest;
use App\Models\Problem;
use App\Models\ProblemTestCase;
use Illuminate\Support\Facades\File;

class TestCaseController extends Controller
{
    public function addTestCase(TestCaseRequest $request)
    {
        $problem = Problem::where(['slug' => request()->slug])->firstOrFail();

        $testCase = ProblemTestCase::create([
            'problem_id' => $problem->id,
            'point'      => $request->point,
        ]);


        return response()->json([
            'message' => 'Successfully added new test case',
        ]);
    }

    public function updateTestCase(TestCaseRequest $request)
    {
        $testCase = Problem::where(['slug' => request()->slug])->firstOrFail()->testCases()->where(['id' => request()->test_case_id])->firstOrFail();

        $input  = ($request->input_type == "upload") ? $request->file('input_file')->get() : $request->input;
        $output = ($request->output_type == "upload") ? $request->file('output_file')->get() : $request->output;

        $testCase->update([
            'point'      => $request->point,
        ]);

        File::put($testCase->input_file, $input);
        File::put($testCase->output_file, $output);

        return response()->json([
            'message' => 'Successfully update test case',
        ]);
    }
    public function updateSample()
    {
        $testCase = Problem::where(['slug' => request()->slug])->firstOrFail()->testCases()->where(['id' => request()->test_case_id])->firstOrFail();

        $testCase->update([
            'sample'      => request()->sample,
        ]);

        return response()->json([
            'message' => 'Successfully update test case sample',
        ]);
        
    }
    public function deleteTestCase()
    {
        $testCase = Problem::where(['slug' => request()->slug])->firstOrFail()->testCases()->where(['id' => request()->test_case_id])->firstOrFail();
        $testCase->delete();
        return response()->json([
            'message' => 'Successfully deleted test case',
        ]);
    }
}

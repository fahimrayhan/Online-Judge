<?php

namespace App\Http\Controllers\TestCase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Problem\TestCaseRequest;
use App\Models\Problem;
use App\Models\ProblemTestCase;
use App\Services\Problem\ProblemService;
use Illuminate\Support\Facades\File;

class TestCaseController extends Controller
{
    protected $problemService;
    private $problem;

    public function __construct(ProblemService $probServc)
    {
        $this->problemService = $probServc;
        if (isset(request()->slug)) {
            $this->problem = $this->problemService->getProblemData(request()->slug);
        }
    }

    public function addTestCase(TestCaseRequest $request)
    {
        $problem = $this->problem;

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
        $testCase = $this->problem->testCases()->where(['id' => request()->test_case_id])->firstOrFail();

        $input  = ($request->input_type == "upload") ? $request->file('input_file')->get() : $request->input;
        $output = ($request->output_type == "upload") ? $request->file('output_file')->get() : $request->output;

        $testCase->update([
            'point' => $request->point,
        ]);

        File::put($testCase->input_file, $input);
        File::put($testCase->output_file, $output);

        return response()->json([
            'message' => 'Successfully update test case',
        ]);
    }
    public function updateSample()
    {
        $testCase = $this->problem->testCases()->where(['id' => request()->test_case_id])->firstOrFail();

        $testCase->update([
            'sample' => request()->sample,
        ]);

        return response()->json([
            'message' => 'Successfully update test case sample',
        ]);

    }
    public function deleteTestCase()
    {
        $testCase = $this->problem->testCases()->where(['id' => request()->test_case_id])->firstOrFail();
        $testCase->delete();
        return response()->json([
            'message' => 'Successfully deleted test case',
        ]);
    }

    public function getTestCaseFromSerial()
    {
        return $this->problem->testCases()->skip(request()->test_case_serial - 1)->take(1)->firstOrFail();
    }

    public function viewInput()
    {
        $testCase = $this->getTestCaseFromSerial();
        echo nl2br(e($testCase->input()));
    }

    public function viewOutput()
    {
        $testCase = $this->getTestCaseFromSerial();
        echo nl2br(e($testCase->output()));
    }

    public function downloadInput()
    {
        $testCase = $this->getTestCaseFromSerial();
        return response()->download($testCase->input_file, 'input-' . request()->test_case_serial . '.txt', [
            'Content-Type: application/txt',
        ]);
    }

    public function downlaodOutput()
    {
        $testCase = $this->getTestCaseFromSerial();
        return response()->download($testCase->output_file, 'output-' . request()->test_case_serial . '.txt', [
            'Content-Type: application/txt',
        ]);
    }
}

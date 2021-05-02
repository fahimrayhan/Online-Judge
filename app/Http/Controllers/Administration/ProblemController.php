<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Services\Problem\ProblemService;

use App\Models\Problem;

class ProblemController extends Controller
{
    /**
     * @var \App\Services\Problem\ProblemService $problemService
     */
    protected $problemService;
    private $problemData;

    /**
     * RegisterController constructor
     *
     * @param  \App\Services\Auth\ProblemService $probServc
     * @return void
     */
    public function __construct(ProblemService $probServc)
    {
        $this->problemService = $probServc;
        if (isset(request()->slug)) {
            $this->problemData = $this->problemService->getProblemData(request()->slug);
        }
    }

    public function overview()
    {
        return view('pages.administration.problem.overview');
    }

    public function details()
    {
        $problemData = $this->problemService->getProblemData(request()->slug);
        return view('pages.administration.problem.details', ['problem' => $this->problemData]);
    }

    public function previewProblem()
    {
        if (isset(request()->modal)) {
            return view('pages.problem.layout.default', ['problem' => $this->problemData]);
        }
        return view('pages.administration.problem.preview_problem', ['problem' => $this->problemData]);
    }

    public function testCaseList()
    {
        return view('pages.administration.problem.test_case.test_case_list', ['problem' => $this->problemData]);
    }

    public function testCaseAdd()
    {
        return view('pages.administration.problem.test_case.add_test_case');
    }
    public function updateTestCase()
    {
        $testCase = Problem::where(['slug' => request()->slug])->firstOrFail()->testCases()->where(['id' => request()->test_case_id])->firstOrFail();
        //dd($testCase);
        return view('pages.administration.problem.test_case.update_test_case', ['testCase' => $testCase]);
    }

    public function deleteProblem(){
        $this->problemData->delete();
    }

    public function checker(){
        return view('pages.administration.problem.checker',['problem' => $this->problemData]);
    }

    
    public function updateSettings()
    {
        return view('pages.administration.problemsettings.info',['problem' => $this->problemData]);
    }
    public function editSettings(Request $req){
        
       $validateData = $req->validate([
          'timelimit' =>'required|numeric|max:10',
          'memorylimit' => 'required|numeric|max:10',
       ]);

       $this->problemData->time_limit = $validateData['timelimit'];
       $this->problemData->memory_limit = $validateData['memorylimit'];
       $this->problemData->save();
      
    }
}

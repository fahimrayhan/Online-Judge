<?php

namespace App\Http\Controllers\Problem;

use App\Http\Controllers\Controller;
use App\Http\Requests\Problem\ProblemCreateRequest;
use App\Services\Problem\ProblemService;
use App\Models\Problem;

class ProblemController extends Controller
{
    /**
     * @var \App\Services\Problem\ProblemService $problemService
     */
    protected $problemService;

    /**
     * RegisterController constructor
     *
     * @param  \App\Services\Auth\ProblemService $probServc
     * @return void
     */
    public function __construct(ProblemService $probServc)
    {
        $this->problemService = $probServc;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.problem.dashboard.problem_create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Problem\ProblemCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProblemCreateRequest $request)
    {
        $this->problemService->createNewProblem($request->all());
        return response()->json([
            'message' => 'Problem Successfully Created',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function updateDetails(ProblemCreateRequest $request)
    {
        $problem = Problem::where(['slug' => request()->slug])->firstOrFail();
        $this->problemService->update($problem, $request->all());
    }

    public function updateChecker()
    {
        $this->problemService->update(request()->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createSubmission()
    {
        $problemData = $this->problemService->getProblemData(request()->slug);
        return view("pages.editor.editor", [
            'problem'   => $problemData,
            'submitUrl' => 'hey',
        ]);
    }
}

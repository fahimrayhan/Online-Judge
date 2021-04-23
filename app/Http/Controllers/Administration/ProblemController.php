<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Services\Problem\ProblemService;

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

    public function overview()
    {
        return view('pages.administration.problem.overview');
    }

    public function details()
    {
        $problemData = $this->problemService->getProblemData(request()->slug);
        return view('pages.administration.problem.details', ['problem' => $problemData]);
    }
}

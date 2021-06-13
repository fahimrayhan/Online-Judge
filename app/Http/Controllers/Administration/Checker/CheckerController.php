<?php

namespace App\Http\Controllers\Administration\Checker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Checker\CheckerService;
use App\Http\Requests\Checker\CreateRequest;
use App\Http\Requests\Checker\UpdateRequest;
use App\Models\Checker;

class CheckerController extends Controller
{

    protected $checkerService;
    protected $checkerData;
    public function __construct(CheckerService $checkerService)
    {
        $this->checkerService = $checkerService;
        if (isset(request()->checkerId)) {
           $this->checkerData = $this->checkerService->getChecker(request()->checkerId);
        }
    }

    public function index()
    {

        return view('pages.administration.settings.checker.index',[
            'checkers' => $this->checkerService->getAllChecker()
        ]);
    }

    public function create()
    {
        return view('pages.administration.settings.checker.create');
    }

    public function store(CreateRequest $request)
    {
        $this->checkerService->createChecker($request->all());
        return response()->json([
            'message' => "Checker Created Successfully"
        ]);
    }

    public function edit()
    {
        return view('pages.administration.settings.checker.edit',['checker' => $this->checkerData]);
    }
    
    public function update(UpdateRequest $request)
    {
        $this->checkerService->updateChecker($this->checkerData,$request->all());
        return response()->json([
            'message' => "Checker Is Updated Successfully"
        ]);
    }

    public function delete()
    {
        $this->checkerData->delete();
        return response()->json([
            "message" => "Checker is Deleted Successfully"
        ]);
    }
}

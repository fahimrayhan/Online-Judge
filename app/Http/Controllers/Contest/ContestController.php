<?php

namespace App\Http\Controllers\Contest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Contest\ContestCreateRequest;
use App\Models\Contest;

class ContestController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.contest.dashboard.contest_create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Problem\ProblemCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContestCreateRequest $request)
    {
        
        $contest = Contest::create($request->all());
        return response()->json([
            'message' => 'Contest Successfully Created',
            'url' => route("administration.contest.overview",[
                'contest_id' => $contest->id
            ])
        ]);
    }

    public function getContestList(){
        $contests = Contest::where(['publish' => 1])->get();
        return view("pages.contest.contest_list",['contests' => $contests]);
    }

    public function contestInfo(){
        $contest = Contest::where(['slug' => request()->contest_slug])->firstOrFail();
        return view("pages.contest.contest_info",['contest' => $contest]);
    }
}

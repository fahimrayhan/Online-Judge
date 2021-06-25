<?php

namespace App\Http\Controllers\Contest;

use App\Http\Controllers\Controller;
use App\Models\Contest;

class ContestArenaController extends Controller
{
	protected $contest;

    public function __construct()
    {
        if (isset(request()->contest_slug)) {
            $this->contest = Contest::where(['slug' => request()->contest_slug])->firstOrFail();
        }
    }
    
    public function problems()
    {
        return view('pages.contest.arena.problems',['contest' => $this->contest]);
    }

    public function viewProblem()
    {
        return view('pages.contest.arena.problems');
    }

    public function submissions()
    {
        return view('pages.contest.arena.submissions',['contest' => $this->contest]);
    }

    public function viewSubmission()
    {
        return view('pages.contest.arena.problems');
    }

    public function standings()
    {
        return view('pages.contest.arena.problems',['contest' => $this->contest]);
    }

    public function clearifications()
    {
        return view('pages.contest.arena.problems',['contest' => $this->contest]);
    }
}

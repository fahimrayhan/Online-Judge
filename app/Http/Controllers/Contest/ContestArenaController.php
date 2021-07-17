<?php

namespace App\Http\Controllers\Contest;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Submission\SubmissionController;
use App\Models\Contest;
use App\Models\Language;
use App\Models\Verdict;

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
        return view('pages.contest.arena.problems', [
            'contest'  => $this->contest,
            'problems' => $this->getProblemListWithKeySerial(),
            'problemsStat' => $this->contest->rankList()->getProblemStat(),
        ]);
    }

    public function completeProblems(){
        return view('pages.contest.arena.complete_problem_set', [
            'contest'  => $this->contest,
            'problems' => $this->getProblemListWithKeySerial(),
        ]);
    }

    public function getProblemListWithKeySerial()
    {
        $problems = $this->contest->problems()->get();
        $tmp      = [];

        foreach ($problems as $key => $value) {
            $tmp[chr($key + 65)] = $value;
        }

        return $tmp;
    }

    public function getProblemListWithKeyId()
    {
        $problems = $this->contest->problems()->get();
        $tmp      = [];

        foreach ($problems as $key => $value) {
            $tmp[$value->id]               = $value;
            $tmp[$value->id]['problem_no'] = chr($key + 65);
        }

        return $tmp;
    }

    public function getProblem()
    {
        $problems = $this->getProblemListWithKeySerial();

        if (!isset($problems[request()->problem_no])) {
            abort(404, "Problem is not found");
        }
        $problem = $problems[request()->problem_no];
        return $problem;
    }

    public function viewProblem()
    {
        $problem = $this->getProblem();
        return view('pages.contest.arena.view_problem', ['contest' => $this->contest, 'problem' => $problem]);
    }

    public function viewSubmitEditor()
    {
        $problem = $this->getProblem();
        return view("pages.editor.editor", [
            'problem'   => $problem,
            'submitUrl' => route('contest.arena.problems.view.submit', [
                'contest_slug' => request()->contest_slug,
                'problem_no'   => request()->problem_no,
            ]),
        ]);
    }

    public function submitProblem()
    {
        $problem = $this->getProblem();
        return (new SubmissionController())->createContestSubmission($this->contest, $problem);
    }

    public function submissions()
    {
        $problems = $this->getProblemListWithKeySerial();
        $problemsKeyId = $this->getProblemListWithKeyId();

        if (request()->problem != "") {
            request()->problem_id = isset($problems[request()->problem]) ? $problems[request()->problem]->id : -1;
        }

        $problemsIdList = [];
        foreach ($problems as $key => $value) {
            array_push($problemsIdList, $value['id']);
        }

        $users = $this->contest->registrationCacheData()->get();
        
        $userIdList = [];
        foreach ($users as $key => $value) {
            if($value->is_registration_accepted)array_push($userIdList, $value->id);
        }

        $submissions = $this->contest->submissions()
            ->whereIn('problem_id',$problemsIdList)
            ->whereIn('user_id',$userIdList)
            ->whereBetween('created_at', [$this->contest->start, $this->contest->end])
            ->whereHas('verdict', function ($q) {
                if (request()->verdict != "") {
                    $q->where('name', request()->verdict);
                }

            })
            ->whereHas('language', function ($q) {
                if (request()->language != "") {
                    $q->where('name', request()->language);
                }
            })
            ->whereHas('user', function ($q) {
                if (request()->handle != "") {
                    $q->where('handle', request()->handle);
                }
            })
            ->whereHas('problem', function ($q) {
                if (request()->problem != "") {
                    $q->where('id', request()->problem_id);
                }
            })
            ->orderBy('id', 'DESC')->paginate(15);

        return view('pages.contest.arena.submissions', [
            'contest'     => $this->contest,
            'submissions' => $submissions,
            'problems'    => $this->getProblemListWithKeySerial(),
            'verdicts'    => Verdict::all(),
            'problemsKeyId' => $problemsKeyId,
            'users' => $users,
            'languages'   => Language::orderBy('name', 'asc')->get(),
        ]);
    }

    public function mySubmissions()
    {
        $problems = $this->getProblemListWithKeySerial();
        $problemsKeyId = $this->getProblemListWithKeyId();

        if (request()->problem != "") {
            request()->problem_id = isset($problems[request()->problem]) ? $problems[request()->problem]->id : -1;
        }

        $problemsIdList = [];
        foreach ($problems as $key => $value) {
            array_push($problemsIdList, $value['id']);
        }

        $users = $this->contest->registrationCacheData()->get();
        
        $userIdList = [];
        foreach ($users as $key => $value) {
            if($value->is_registration_accepted)array_push($userIdList, $value->id);
        }

        $submissions = $this->contest->submissions()->where(['user_id' => auth()->user()->id])
            ->whereIn('problem_id',$problemsIdList)
            ->whereIn('user_id',$userIdList)
            ->whereBetween('created_at', [$this->contest->start, $this->contest->end])
            ->whereHas('verdict', function ($q) {
                if (request()->verdict != "") {
                    $q->where('name', request()->verdict);
                }

            })
            ->whereHas('language', function ($q) {
                if (request()->language != "") {
                    $q->where('name', request()->language);
                }
            })
            ->whereHas('user', function ($q) {
                if (request()->handle != "") {
                    $q->where('handle', request()->handle);
                }
            })
            ->whereHas('problem', function ($q) {
                if (request()->problem != "") {
                    $q->where('id', request()->problem_id);
                }
            })
            ->orderBy('id', 'DESC')->paginate(15);

        return view('pages.contest.arena.submissions', [
            'contest'     => $this->contest,
            'submissions' => $submissions,
            'problems'    => $problems,
            'verdicts'    => Verdict::all(),
            'problemsKeyId' => $problemsKeyId,
            'users' => $users,
            'languages'   => Language::orderBy('name', 'asc')->get(),
        ]);
    }

    public function viewSubmission()
    {
        $problems = $this->getProblemListWithKeyId();

        $problemsIdList = [];
        foreach ($problems as $key => $value) {
            array_push($problemsIdList, $value['id']);
        }

        $users = $this->contest->registrationCacheData()->get();
        
        $userIdList = [];
        foreach ($users as $key => $value) {
            if($value->is_registration_accepted)array_push($userIdList, $value->id);
        }

        $submission = $this->contest->submissions()
        ->where(['id' => request()->submission_id])
        ->whereIn('problem_id',$problemsIdList)
        ->whereIn('user_id',$userIdList)
        ->firstOrFail();

        //dd($problems);

        return view('pages.contest.arena.view_submission', [
            'contest'    => $this->contest,
            'submission' => $submission,
            'users' => $users,
            'problemKey' => $problems[$submission->problem_id]['problem_no']
        ]);
    }

    public function standings()
    {
        return view('pages.contest.arena.standings', [
            'contest'  => $this->contest,
            'rankList' => $this->contest->rankList()->get(),
            'problems' => $this->contest->rankList()->getProblemStat(),
        ]);
    }

    public function clearifications()
    {
        
    }
}

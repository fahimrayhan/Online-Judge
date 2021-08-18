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
    protected $problems;

    //test
    public function __construct()
    {
        if (isset(request()->contest_slug)) {
            $this->contest  = Contest::where(['slug' => request()->contest_slug])->firstOrFail();
            $this->problems = new \App\Services\Contest\ContestProblem($this->contest);
        }
    }

    public function problems()
    {
        return view('pages.contest.arena.problems', [
            'contest'       => $this->contest,
            'problems'      => $this->problems->get(),
            'problemsStat'  => $this->contest->rankList()->getProblemStat(),
            'announcements' => $this->contest->announcements()->orderBy('id', 'desc')->get(),
        ]);
    }

    public function completeProblems()
    {
        return view('pages.contest.arena.complete_problem_set', [
            'contest'  => $this->contest,
            'problems' => $this->problems->get(),
        ]);
    }

    public function getProblem()
    {
        $problem = $this->problems->whereNo(request()->problem_no);
        if (empty($problem)) {
            abort(404, "Problem is not found");
        }
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
        $problems = $this->problems->get();

        if (request()->problem != "") {
            $problem              = $this->problems->whereNo(request()->problem);
            request()->problem_id = empty($problem) ? -1 : $problem->id;
        }

        $problemsIdList = [];
        foreach ($problems as $key => $value) {
            array_push($problemsIdList, $value['id']);
        }

        $users = $this->contest->registrationCacheData()->get();

        $userIdList = [];
        foreach ($users as $key => $value) {
            if ($value->is_registration_accepted) {
                array_push($userIdList, $value->id);
            }
        }

        $submissions = $this->contest->submissions()
            ->whereIn('problem_id', $problemsIdList)
            ->whereIn('user_id', $userIdList)
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

        $submissions->each(function ($submission) use ($users) {
            $submission->problem_no = $this->problems->whereId($submission->problem_id)->problem_no;
            $submission->main_name  = $users[$submission->user->id]->main_name;
        });

        return view('pages.contest.arena.submissions', [
            'contest'     => $this->contest,
            'submissions' => $submissions,
            'problems'    => $problems,
            'verdicts'    => Verdict::all(),
            'languages'   => Language::orderBy('name', 'asc')->get(),
        ]);
    }

    public function mySubmissions()
    {
        $problems = $this->problems->get();

        if (request()->problem != "") {
            $problem              = $this->problems->whereNo(request()->problem);
            request()->problem_id = empty($problem) ? -1 : $problem->id;
        }

        $problemsIdList = [];
        foreach ($problems as $key => $value) {
            array_push($problemsIdList, $value['id']);
        }

        $users = $this->contest->registrationCacheData()->get();

        $userIdList = [];
        foreach ($users as $key => $value) {
            if ($value->is_registration_accepted) {
                array_push($userIdList, $value->id);
            }

        }

        $submissions = $this->contest->submissions()->where(['user_id' => auth()->user()->id])
            ->whereIn('problem_id', $problemsIdList)
            ->whereIn('user_id', $userIdList)
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

        $submissions->each(function ($submission) use ($users) {
            $submission->problem_no = $this->problems->whereId($submission->problem_id)->problem_no;
            $submission->main_name  = $users[$submission->user->id]->main_name;
        });

        return view('pages.contest.arena.submissions', [
            'contest'     => $this->contest,
            'submissions' => $submissions,
            'problems'    => $problems,
            'verdicts'    => Verdict::all(),
            'languages'   => Language::orderBy('name', 'asc')->get(),
        ]);
    }

    public function viewSubmission()
    {
        $problems = $this->problems->get();

        $problemsIdList = [];
        foreach ($problems as $key => $value) {
            array_push($problemsIdList, $value['id']);
        }

        $users = $this->contest->registrationCacheData()->get();

        $userIdList = [];
        foreach ($users as $key => $value) {
            if ($value->is_registration_accepted) {
                array_push($userIdList, $value->id);
            }

        }

        $submission = $this->contest->submissions()
            ->where(['id' => request()->submission_id])
            ->whereIn('problem_id', $problemsIdList)
            ->whereIn('user_id', $userIdList)
            ->firstOrFail();

        $submission->problem_no = $this->problems->whereId($submission->problem_id)->problem_no;
        $submission->main_name  = $users[$submission->user->id]->main_name;

        //dd($problems);
        $problem = $this->problems->whereId($submission->problem_id);

        return view('pages.contest.arena.view_submission', [
            'contest'    => $this->contest,
            'submission' => $submission,
            'users'      => $users,
            'problemKey' => $problem['problem_no'],
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

    public function announcements(){
        echo "hey";
    }

    public function showAnnouncements(){
        
    }
}

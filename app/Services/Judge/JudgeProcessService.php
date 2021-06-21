<?php
namespace App\Services\Judge;
use Carbon\Carbon;
use App\Models\Submission;
use App\Events\SubmissionEvent;
use App\Events\TestCaseEvent;

class JudgeProcessService
{
    protected $multiProcessStart;
    protected $serverNo;
    protected $totalServer = 1;
    
    public function __construct($serverNo = 1)
    {
        $this->serverNo = $serverNo - 1;

        if ($this->totalServer == 0) {
            exit();
        }
        
        if ($this->serverNo > $this->totalServer) {
            exit();
        }
    }
    
    public function multiProcess($isStart = true)
    {
        if ($isStart) {
            $this->multiProcessStart = Carbon::now()->timestamp;
        }

        $now = Carbon::now()->timestamp;
        if (($now - $this->multiProcessStart) >= 55) {
            return;
        }

        $this->process();
        usleep(400000);
        
        $this->multiProcess(false);
    }

    public function process()
    {
        $checkTotalRunning = $this->checkTotalRunningSubmissons();
        if (!$checkTotalRunning) {
            return;
        }

        $this->verdictStatus();
    }

    public function checkTotalRunningSubmissons()
    {
        $totalRunningLimit = 15;
        $total             = Submission::where(['verdict_id' => 2, 'judge_status' => 'judging'])->get()->count();
        return $total < $totalRunningLimit ? 1 : 0;
    }

    public function verdictStatus()
    {
        $submission = Submission::where(['verdict_id' => 1, 'judge_status' => 'test_case_ready'])->whereRaw("id MOD {$this->totalServer} = {$this->serverNo}")->first();
        if (empty($submission)) {
            return;
        }

        $testCase = $submission->testCases()->first();
        $submission->update([
            'judge_status' => "judging",
            'verdict_id'   => 2,
        ]);
        $testCase->update([
            'verdict_id' => 2,
        ]);
        event(new SubmissionEvent($submission,[$testCase]));
    }
}
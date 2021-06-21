<?php
namespace App\Services\Judge;

use App\Events\SubmissionEvent;
use App\Models\Submission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class JudgeService
{
    protected $multiJudgeStart;
    protected $submission;
    protected $testCase;
    protected $apiUrl;
    protected $serverNo;
    protected $totalServer = 1;
    protected $serverList  = [
        'http://134.122.52.123/JudgerController/judger/judger-egjruvkcix/api/api.php',
        'http://134.122.52.123/JudgerController//judger/judger-gmharkjqkt/api/api.php',
        'http://134.122.52.123/JudgerController//judger/judger-buvqrmsydi/api/api.php',
        'http://134.122.52.123/JudgerController//judger/judger-uooyfyecxn/api/api.php',
        'http://134.122.52.123/JudgerController//judger/judger-flwzvkkbpj/api/api.php',
    ];

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

    public function multiJudge($isStart = true)
    {
        if ($isStart) {
            $this->multiJudgeStart = Carbon::now()->timestamp;
        }

        $now = Carbon::now()->timestamp;
        if (($now - $this->multiJudgeStart) >= 55) {
            return;
        }

        $this->judge();

        if (empty($this->submission)) {
            sleep(1);
        } else {
            usleep(100000);
        }

        $this->multiJudge(false);
    }

    public function judge()
    {
        $this->submission = Submission::where(['judge_status' => 'judging', 'verdict_id' => 2])->whereRaw("id MOD {$this->totalServer} = {$this->serverNo}")->orderBy('id', 'ASC')->first();
        if (empty($this->submission)) {
            return 0;
        }

        $this->testCase = $this->submission->testCases()->skip($this->submission->run_on_test - 1)->first();

        $tokenData = $this->sendServer();
        $this->updateJudgeData($tokenData);

    }

    public function sendServer()
    {

        $data = [
            'source_code'         => base64_encode($this->submission->source_code),
            'language'            => $this->submission->language->code,
            'time_limit'          => sprintf('%0.3f', ($this->submission->problem->time_limit / 1000)),
            'memory_limit'        => $this->submission->problem->memory_limit,
            'input'               => base64_encode($this->testCase->readInput()),
            'expected_output'     => base64_encode($this->testCase->readExpectedOutput()),
            'checker_type'        => $this->submission->problem->checker_type,
            'default_checker'     => $this->submission->problem->default_checker,
            'custom_checker'      => base64_encode($this->submission->problem->custom_checker),
            'compile_file'        => hash('sha256', request()->ip() . "-submission-{$this->submission->id}-{$this->submission->created_at->timestamp}->compile_file"),
            'delete_compile_file' => $this->submission->run_on_test == $this->submission->total_test_case ? 1 : 0,
            'api_type'            => 'submission',
        ];

        $url      = $this->serverList[$this->serverNo];
        $response = Http::asForm()->post($url, $data);
        $response = json_decode($response);

        $response->input           = $this->compressString(base64_decode($data['input']));
        $response->output          = $this->compressString(base64_decode($response->output));
        $response->expected_output = $this->compressString(base64_decode($data['expected_output']));
        $response->verdict_id      = $response->status->id;

        return $response;
    }

    public static function compressString($str, $len = 250)
    {
        $stringLen = strlen($str);
        if ($stringLen <= $len) {
            return $str;
        }

        return substr($str, 0, $len) . "...";
    }

    public function updateJudgeData($tokenData)
    {
        $verdictId = -1;
        if (isset($tokenData->verdict[0]->id)) {
            $verdictId = $tokenData->verdict[0]->id;
        } else if (isset($tokenData->verdict_id)) {
            $verdictId = $tokenData->verdict_id;
        }

        if ($verdictId <= 2) {
            return;
        }

        $submission = $this->submission;
        $testCase   = $this->testCase;

        $submission->passed_point += $verdictId == 3 ? $testCase->point : 0;

        $judgeFinish = $submission->run_on_test == $submission->total_test_case;
        $judgeFinish |= ($verdictId > 3 && $submission->judge_type == 'binary');

        if ($judgeFinish == 1) {
            $submission->judge_status = "judge_finish";
            $submission->time         = max($tokenData->time * 1000, $submission->testCases()->max('time'));
            $submission->memory       = max($tokenData->memory, $submission->testCases()->max('memory'));
            if ($submission->judge_type == "binary") {
                $submission->verdict_id = $verdictId;
            } else {
                if ($submission->passed_point == 0) {
                    $submission->verdict_id = 15;
                } else if ($submission->passed_point < $submission->total_point) {
                    $submission->verdict_id = 14;
                } else {
                    $submission->verdict_id = 13;
                }

            }
        } else {
            $submission->run_on_test += 1;
        }

        $testCase->input           = $tokenData->input;
        $testCase->output          = $tokenData->output;
        $testCase->expected_output = $tokenData->expected_output;
        $testCase->time            = $tokenData->time * 1000;
        $testCase->memory          = $tokenData->memory;
        $testCase->checker_log     = $tokenData->checker_log;
        $testCase->compiler_log    = $tokenData->compiler_log;
        $testCase->verdict_id      = $verdictId;

        $testCaseList = [];
        array_push($testCaseList, $testCase);

        if ($judgeFinish == 0) {
            $nextTestCase = $submission->testCases()->skip($submission->run_on_test - 1)->first();
            $nextTestCase->update([
                'verdict_id' => 2,
            ]);
            array_push($testCaseList, $nextTestCase);

        }

        if ($judgeFinish == 1) {
            $testCases = $submission->testCases()->skip($submission->run_on_test)->take(PHP_INT_MAX)->get();
            foreach ($testCases as $key => $skipTestCase) {
                $skipTestCase->update([
                    'verdict_id' => 16,
                ]);
                array_push($testCaseList, $skipTestCase);
            }
        }

        $testCase->save();
        $submission->save();

        event(new SubmissionEvent($submission, $testCaseList));

    }

}

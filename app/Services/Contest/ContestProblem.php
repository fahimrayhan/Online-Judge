<?php
namespace App\Services\Contest;

use App\Models\Contest;

class ContestProblem
{
    private $problems;
    private $cacheKey;
    private $contest;

    public function __construct(Contest $contest)
    {
        $this->cacheKey = "contest_problems_{$contest->id}";
        $this->contest  = $contest;
        $this->problems = $this->getCache();
    }

    public function getCache()
    {
        //cache()->flush();
        return cache()->rememberForever($this->cacheKey, function () {
            return $this->processData();
        });
    }

    public function processData()
    {
        $problems = $this->contest->problems()->get();
        $tmp      = [];
        foreach ($problems as $key => $problem) {
            $problem['problem_no'] = chr($key + 65);
            array_push($tmp, $problem);
        }
        return $tmp;
    }

    public function updateCache()
    {
        cache()->put($this->cacheKey, $this->processData());
    }

    public function get()
    {
        return $this->problems;
    }

    public function whereId($id)
    {
        $key     = array_search($id, array_column($this->problems, 'id'));
        $problem = $this->problems[$key];
        if ($problem->id != $id) {
            return [];
        }
        return $problem;
    }

    public function whereNo($no)
    {
        $key     = array_search(strtoupper($no), array_column($this->problems, 'problem_no'));
        $problem = $this->problems[$key];
        if ($problem->problem_no != strtoupper($no)) {
            return [];
        }
        return $problem;
    }
}

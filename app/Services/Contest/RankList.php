<?php
namespace App\Services\Contest;

use App\Models\Contest;

/**
 *
 */
class RankList
{
    protected $contest;
    protected $cacheRankListKey;
    protected $cacheProblemStatKey;

    public function __construct(Contest $contest)
    {
        $this->contest             = $contest;
        $this->cacheRankListKey    = "contest_" . $contest->id . "_ranklist";
        $this->cacheProblemStatKey = "contest_" . $contest->id . "_problem_stat";
    }

    public function getProblemListWithKeyId()
    {
        $problems = $this->contest->problems()->get();
        $tmp      = [];

        foreach ($problems as $key => $problem) {
            $tmp[$problem->id]               = $problem;
            $tmp[$problem->id]['problem_no'] = chr($key + 65);
        }

        return $tmp;
    }

    public function buildRankList()
    {
        $users             = $this->contest->registrationCacheData()->get();
        $problemSolvedStat = [];

        $problems = $this->getProblemListWithKeyId();

        foreach ($problems as $key => $problem) {
            $problemSolvedStat[$problem->id] = [
                'attempted' => 0,
                'solved'    => 0,
                'no'        => $problem->problem_no,
                'solved_by' => [],
            ];
        }

        // dd($users);

        $rankList = [];

        $submissions = $this->contest->submissions()
            ->whereBetween('created_at', [$this->contest->start, $this->contest->end])
            ->where('verdict_id', '>', 2)
            ->get();

        foreach ($submissions as $key => $submission) {
            $userId    = $submission->user->id;
            $problemId = $submission->problem_id;
            $verdictId = $submission->verdict_id;
            $panalty   = $submission->created_at->diffInMinutes($this->contest->start);

            if (!isset($problems[$problemId])) {
                continue;
            }

            if (!isset($users[$userId])) {
                continue;
            }

            if (!$users[$userId]->is_registration_accepted) {
                continue;
            }

            //ini array store
            if (!isset($rankList[$userId])) {
                $rankList[$userId] = [
                    'total_solved'  => 0,
                    'total_panalty' => 0,
                    'handle'        => $submission->user->handle,
                    'main_name'     => $users[$userId]->main_name,
                    'sub_name'      => $users[$userId]->sub_name,
                    'problems'      => [],
                ];
            }

            $problemStat = $rankList[$userId]['problems'];

            //check if 3

            if (!isset($problemStat[$problemId])) {
                $problemStat[$problemId] = [
                    'attempted' => 0,
                    'panalty'   => 0,
                    'verdict'   => -1,
                ];
            }

            $problemStat = $problemStat[$problemId];

            if ($problemStat['verdict'] == 3) {
                continue;
            }

            $attempted = $problemStat['attempted'];

            $problemStat = [
                'attempted' => $attempted + 1,
                'panalty'   => $verdictId == 3 ? $panalty + ($attempted * 20) : 0,
                'verdict'   => $verdictId,
            ];

            if ($verdictId == 3) {
                $rankList[$userId]['total_solved']++;
                $rankList[$userId]['total_panalty'] += $problemStat['panalty'];
            }
            $rankList[$userId]['problems'][$problemId] = $problemStat;

            $problemSolvedStat[$problemId]['attempted'] += $problemStat['attempted'] == 1;
            $problemSolvedStat[$problemId]['solved_by'][$userId] = 0;
            if ($problemStat['verdict'] == 3) {
                $problemSolvedStat[$problemId]['solved'] += 1;
                $problemSolvedStat[$problemId]['solved_by'][$userId] = 1;
            }

        }

        if (!empty($rankList)) {
            usort($rankList, function ($a, $b) use ($key) {
                if ($a['total_solved'] == $b['total_solved']) {
                    return $a['total_panalty'] <=> $b['total_panalty'];
                }

                return $b['total_solved'] <=> $a['total_solved'];
            });
        }

        // dd($problemSolvedStat);

        return [
            'problemStat' => $problemSolvedStat,
            'rankList'    => $rankList,
        ];
    }

    public function save()
    {
        $data = $this->buildRankList();

        cache()->put($this->cacheRankListKey, $data['rankList']);
        cache()->put($this->cacheProblemStatKey, $data['problemStat']);

        return $data;
    }

    public function get()
    {
        return cache()->get($this->cacheRankListKey, function () {
            $data = $this->save();
            return $data['rankList'];
        });
    }

    public function getProblemStat()
    {
        return cache()->get($this->cacheProblemStatKey, function () {
            $data = $this->save();
            return $data['problemStat'];
        });
    }
}

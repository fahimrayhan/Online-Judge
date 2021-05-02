<?php

namespace App\Services\Problem;

use App\Models\Problem;

class ProblemService
{
    /**
     * Create New User
     *
     * @param  array $data
     * @return void
     */
    public function createNewProblem($data)
    {
        return Problem::create($data);
    }

    public function update($data)
    {
        if (isset($data['_token'])) unset($data['_token']);
        return Problem::where(['slug' => request()->slug])->update($data);
    }

    public function getProblemData($slug)
    {
        return Problem::where(['slug' => $slug])->firstOrFail();
    }

    public function addLanguages(Problem $problem, $data)
    {
        // dd($data);
        $pivot = array();
        foreach ($data['languages'] as $d) {
            $pivot[$d] = ['time_limit' => 1, 'memory_limit' => 1];
        }
        $problem->languages()->sync($pivot);
        return $problem;
    }

    public function updateLanguage(Problem $problem, $data,$language_id)
    {
        $problem->languages()->updateExistingPivot($language_id,[
            'time_limit' => $data['time_limit'],
             'memory_limit' => $data['memory_limit'],
            ]);
    }
}

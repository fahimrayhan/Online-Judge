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

    public function update(Problem $problem, $data)
    {
        if (isset($data['_token'])) {
            unset($data['_token']);
        }

        if (isset($data['name'])) {
            if (\Str::slug($problem->name) != \Str::slug($data['name'])) {
                $data['slug'] = $this->createSlug($data['name']);
            }
        }

        return $problem->update($data);
    }

    public function getProblemData($slug)
    {
        return Problem::where(['slug' => $slug])->firstOrFail();
    }

    public function createSlug($problemName)
    {
        $slug = \Str::slug($problemName);

        if($slug == "")$slug = "problem";

        // check to see if any other slugs exist that are the same & count them
        $count = Problem::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        while (1) {
            $tmpSlug = $count ? "{$slug}-{$count}" : $slug;
            if (Problem::where('slug', '=', $tmpSlug)->exists()) {
                $count++;
                continue;
            }
            break;
        }
        // if other slugs exist that are the same, append the count to the slug
        $slug = $count ? "{$slug}-{$count}" : $slug;

        return $slug;
    }

    public function addLanguages(Problem $problem, $data)
    {
        // dd($data);
        $pivot = array();

        foreach ($data['languages'] as $language_id) {
            $pivot[$language_id] = [
                'time_limit'   => (float) max($data['time_limit'][$language_id], 0.1),
                'memory_limit' => (float) max($data['memory_limit'][$language_id], 0.1),
            ];
        }
        $problem->languages()->sync($pivot);
        return $problem;
    }

    public function updateTimeAndMemory(Problem $problem, $data)
    {
        $problem->time_limit   = $data['time_limit'];
        $problem->memory_limit = $data['memory_limit'];
        $problem->save();
        return $problem;
    }
}

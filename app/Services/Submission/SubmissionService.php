<?php

namespace App\Services\Submission;

use App\Models\Problem;
use App\Models\Submission;

class SubmissonService
{
    public function createSubmission($data)
    {
        $data['source_code'] = base64_decode($data['source_code']);

        $problem = Problem::where(['problem_slug' => request()->slug])->firstOrFail();

        // return Language::create($data);
    }

    public function getSubmissionListWithFilter($filter)
    {

        $submissions = Submission::where([])
            ->whereHas('verdict', function ($q) {

            	$filterType = $filter['verdict'];
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
                if (request()->slug != "") {
                    $q->where('slug', request()->slug);
                }
            })
            ->orderBy('id', 'DESC')->paginate(15);
    }

}

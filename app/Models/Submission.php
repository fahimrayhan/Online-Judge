<?php

namespace App\Models;

use App\Models\Language;
use App\Models\Problem;
use App\Models\SubmissionTestCase;
use App\Models\Traits\Submission\SubmissionType;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use SubmissionType;

    protected $fillable = [
        'problem_id', 'verdict_id', 'language_id', 'user_id', 'type', 'judge_type', 'judge_status', 'source_code', 'time_limit', 'memory_limit', 'time', 'memory', 'run_on_test', 'total_test_case', 'total_point', 'passed_point', 'created_at', 'updated_at',
    ];

    protected $appends = ['type_string', 'language_name', 'verdict_name'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($submission) {
            $submission->verdict_id = 1;
            $submission->time       = 0;
            $submission->memory     = 0;
            $submission->user_id    = auth()->user()->id;

            $problem  = Problem::where(['id' => $submission->problem_id])->firstOrFail();
            $language = $problem->getLanguage($submission->language_id);
            if (empty($language)) {
                abort(419, "Language is not found");
            }

            $submission->time_limit   = (int) ceil($language->time_limit * $problem->time_limit);
            $submission->memory_limit = (int) ceil($language->memory_limit * $problem->memory_limit);

        });

        // auto-sets values on creation
        static::created(function ($submission) {
            $submission->createTestCase();
        });
    }

    public function createTestCase()
    {
        $problem   = Problem::where(['id' => $this->problem_id])->firstOrFail();
        $testCases = $problem->testCases()->get();
        //dd($testCases);
        $totalPoint = 0;
        foreach ($testCases as $key => $testCase) {
            $totalPoint += $testCase->point;
            SubmissionTestCase::create([
                'submission_id' => $this->id,
                'verdict_id'    => 1,
                'hash_file'     => $testCase->hash_id,
                'point'         => $testCase->point,
            ]);
        }

        $this->total_test_case = count($testCases);
        $this->total_point     = $totalPoint;
        $this->verdict_id      = count($testCases) == 0 ? 3 : 1;
        $this->judge_status    = "test_case_ready";
        $this->save();
    }

    public function getTypeAttribute($type)
    {
        if ($type == 1) {
            return "testing";
        } else if ($type == 2) {
            return "practice";
        } else {
            return "contest";
        }

    }

    public function testCases()
    {
        return $this->hasMany(SubmissionTestCase::class);
    }

    public function language()
    {

        return $this->belongsTo(Language::class);
    }


    public function getLanguageAttribute()
    {
        return cache()->rememberForever("submission_language_" . $this->language_id, function () {
            return $this->language()->first();
        });
    }

    public function problem()
    {
        return $this->belongsTo(Problem::class);
    }

    public function getProblemAttribute()
    {
        return cache()->rememberForever("submission_problem_" . $this->problem_id, function () {
            return $this->problem()->first();
        });
    }

    public function contest()
    {
        return $this->belongsToMany(Contest::class, 'contest_submission', 'submission_id', 'contest_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserAttribute()
    {
        return cache()->rememberForever("submission_user_" . $this->user_id, function () {
            return $this->user()->first();
        });
    }

    public function verdict()
    {
        return $this->belongsTo(Verdict::class);
    }

    public function getVerdictAttribute()
    {
        return cache()->rememberForever("submission_verdict_" . $this->verdict_id, function () {
            return $this->verdict()->first();
        });
    }

    public function verdictStatus()
    {
        return $this->verdict->statusClass([
            'running_on_test' => true,
            'total_test_case' => $this->total_test_case,
            'run_on_test'     => $this->run_on_test,
            'judge_type'      => $this->judge_type,
            'total_point'     => $this->total_point,
            'passed_point'    => $this->passed_point,
        ]);
    }

}

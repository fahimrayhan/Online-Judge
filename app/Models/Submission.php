<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'problem_id', 'verdict_id', 'language_id', 'user_id', 'type', 'judge_type', 'source_code', 'time_limit', 'memory_limit', 'time', 'memory', 'run_on_test', 'total_test_case', 'total_point', 'passed_point', 'created_at', 'updated_at',
    ];


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($submission) {
            $submission->verdict_id = 1;
            $submission->type = 1;
            $submission->user_id = auth()->user()->id;
        });

        // auto-sets values on creation
        static::created(function ($submission) {
            
        });

        static::deleted(function ($submission) {
            
        });
    }

}

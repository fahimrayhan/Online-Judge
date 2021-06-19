<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProblemTestCase extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'hash_id', 'point', 'sample', 'problem_id',
    ];

    protected $appends = ['input_file,output_file'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'point'  => 'integer',
        'sample' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($testCase) {
            // produce a slug based on the activity title
            $testCase->user_id = auth()->user()->id;
        });

        // auto-sets values on creation
        static::created(function ($testCase) {
            $hash              = hash('sha256', Str::random(20) . "_" . rand() . "_" . $testCase->id . "_" . Carbon::now()->timestamp);
            $testCase->hash_id = $hash;
            $testCase->save();

            $input  = (request()->input_type == "upload") ? request()->file('input_file')->get() : request()->input;
            $output = (request()->output_type == "upload") ? request()->file('output_file')->get() : request()->output;

            File::put($testCase->input_file, $input);
            File::put($testCase->output_file, $output);
        });

        static::deleted(function ($testCase) {
            File::delete($testCase->input_file, $testCase->output_file);
        });
    }

    public function getInputFileAttribute()
    {
        return public_path().'/file/test_case/input/' . $this->hash_id . ".txt";
    }

    public function getOutputFileAttribute()
    {
        return public_path().'/file/test_case/output/' . $this->hash_id . ".txt";
    }

    public function inputLastModified(){
        return Carbon::createFromTimestamp(File::lastModified($this->input_file));
    }

    public function outputLastModified(){
        return Carbon::createFromTimestamp(File::lastModified($this->output_file));
    }

    public function inputLength()
    {
        return File::exists($this->input_file) ? File::size($this->input_file) : 0;
    }

    public function outputLength()
    {
        return File::exists($this->output_file) ? File::size($this->output_file) : 0;
    }

    public function input()
    {
        return File::exists($this->input_file) ? File::get($this->input_file) : "";
    }

    public function output()
    {
        return File::exists($this->output_file) ? File::get($this->output_file) : "";
    }

    public function problem()
    {
        return $this->belongsTo(Problem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

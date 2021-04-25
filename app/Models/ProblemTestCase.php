<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ProblemTestCase extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'hash_id', 'point', 'sample','problem_id'
    ];

    protected $appends = ['input_file,output_file'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'point' => 'integer',
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
            $hash = hash('sha256',Str::random(20). "_" . rand() . "_" . $testCase->id . "_" . Carbon::now()->timestamp);
            $testCase->hash_id = $hash;
            $testCase->save();

            File::put($testCase->input_file,isset(request()->input) ? request()->input : "");
            File::put($testCase->output_file,isset(request()->output) ? request()->output : "");
        });
    }

    public function getInputFileAttribute(){
        return 'file/test_case/input/'.$this->hash_id.".txt";
    }

    public function getOutputFileAttribute(){
        return 'file/test_case/output/'.$this->hash_id.".txt";
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

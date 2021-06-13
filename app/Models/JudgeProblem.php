<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JudgeProblem extends Model
{
    protected $fillable = [
        'problem_id', 'user_id'
    ];

    public function problem()
    {
        return $this->belongsTo(Problem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

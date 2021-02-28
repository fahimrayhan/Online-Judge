<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function createdProblems()
    {
      return $this->hasMany(Problem::class);
    }
    public function moderateProblems()
    {
       return $this->belongsTosMany(Problem::class,'moderators');
    }
    public function createdTestCases()
    {
        return $this->hasMany(TestCase::class);
    }
}

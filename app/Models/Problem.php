<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{

  public function testCases()
  {
    return $this->hasMany(ProblemTestCase::class);
  }
  public function users()
  {
    return $this->belongsTosMany(User::class,'problem_moderator');
  }
}

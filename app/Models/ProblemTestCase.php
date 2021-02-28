<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProblemTestCase extends Model
{
    public function problem()
    {
      return $this->belongsTo(Problem::class);
    }
    public function createdBy()
    {
      return $this->belongsTo(User::class);
    }
}

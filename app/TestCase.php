<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestCase extends Model
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

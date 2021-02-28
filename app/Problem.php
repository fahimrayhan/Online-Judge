<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    public function createdBy()
    {
      return $this->belongsTo(User::class);
    }
    public function testCases()
    {
      return $this->hasMany(TestCase::class);
    }

    public function moderators()
    {
      return $this->belongsTosMany(User::class,'moderators');
    }
}

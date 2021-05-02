<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name', 'code'
    ];

    public function problems()
    {
        return $this->belongsToMany(Problem::class)->withPivot('time_limit','memory_limit');
    }
}

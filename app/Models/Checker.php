<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checker extends Model
{
    protected $fillable = [
        'name','description','code'
    ];
}
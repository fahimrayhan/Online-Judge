<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContestAnnouncement extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'description', 'is_published', 'contest_id','user_id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($announcement) {
            $announcement->user_id = auth()->user()->id;
        });
        
    }

    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

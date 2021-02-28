<?php

namespace App\Models;

use App\Models\Traits\User\UserType;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, UserType;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'handle', 'name', 'email', 'password', 'avatar', 'type', 'last_login', 'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($user) {
           $user->type = $user->getUserType();
           $user->password = bcrypt($user->password);
        });
    }

    public function problems()
    {
      return $this->belongsTosMany(Problem::class,'problem_moderator');
    }
    public function acceptedProblems()
    {
      return $this->problems()->wherePivot('is_accepted',true);
    }
    public function pendingProblems()
    {
      return $this->problems()->wherePivot('is_accepted',false);
    }


}

<?php

namespace App\Http\Middleware\Contest\Arena;

use Closure;
use App\Models\Contest;

class CheckContestStart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $contest = Contest::where(['slug' => request()->contest_slug,'publish' => 1])->firstOrFail();

        if($contest->status == "upcomming"){
            return response(view("pages.contest.arena.arena_error",[
                'contest' => $contest,
                'error' => "Contest Is Not Start"
            ]));
        }
        
        return $next($request);
    }
}

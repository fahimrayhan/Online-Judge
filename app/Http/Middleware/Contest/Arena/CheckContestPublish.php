<?php

namespace App\Http\Middleware\Contest\Arena;

use Closure;
use App\Models\Contest;

class CheckContestPublish
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

        return $next($request);
    }
}

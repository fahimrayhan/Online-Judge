<?php

namespace App\Http\Middleware\Administration\Problem;

use Closure;
use App\Models\Problem;

class HasAccess
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
        $problem = Problem::where(['slug' => request()->slug])->firstOrFail();
        $hasAccess = auth()->user()->problems()->where('problem_id',$problem->id)->first();
        if(!$hasAccess)
        {
            abort(401);
        }

        return $next($request);
    }
}

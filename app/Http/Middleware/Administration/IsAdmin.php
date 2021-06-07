<?php

namespace App\Http\Middleware\Administration;

use Closure;

class IsAdmin
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
        $user = auth()->user();
        $role = $user ? $user->type : abort(401);
        if($role != "super_admin")
        {
            abort(401);
        }
        return $next($request);
    }
}

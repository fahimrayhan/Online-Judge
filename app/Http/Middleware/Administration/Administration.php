<?php

namespace App\Http\Middleware\Administration;

use Closure;

class Administration
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
        if(!in_array($role,array('super_admin','admin','moderator')))
        {
            abort(401);
        }
        return $next($request);
    }
}

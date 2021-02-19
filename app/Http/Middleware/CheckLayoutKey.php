<?php

namespace App\Http\Middleware;
use App\Services\Layout\Layout;
use Illuminate\Http\Response;
use Closure;

class CheckLayoutKey
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
        if(!Layout::checkLayoutKey() || !isset(request()->check_layout)){
            abort(404, 'Page Not Found');
        }
        return $next($request);
    }
}

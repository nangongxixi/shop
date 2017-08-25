<?php

namespace App\Http\Middleware;

use Closure;

class BrowserTag
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
        //$response = $next($request);

        $tag = \Cookie::get('browser_tag');

        if(empty($tag)){
            $val = uniqid();

            \Cookie::queue(\Cookie::forever('browser_tag',$val));
        }

        return $next($request);

    }
}

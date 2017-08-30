<?php

namespace App\Http\Middleware;

use Closure;

class AuthMember
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

        //如果没有登录，跳转到会员的登录页面
        if(auth()->guard('member')->guest()){
            //将当前url放入session，登录成功后，回到此url中
            $returnUrl = $request->getUri();
            session(['returnUrl'=>$returnUrl]);
            return redirect('member/login');
        }
        return $next($request);
    }
}

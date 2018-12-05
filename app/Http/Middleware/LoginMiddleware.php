<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
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
        // 获取用户id
        $uid = session("uid");

        // 查看路径
        /*$active = \Route::current()->getActionName();
        dump($active)*/; // exit;

        if ($uid) {
            return $next($request);
        } else {
            return redirect("admin/login");
        }
    }
}

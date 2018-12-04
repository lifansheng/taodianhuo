<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Admin\User;
use App\Model\Admin\Role;
use App\Model\Admin\Permission;
use DB;

class UserPermissionMiddleware
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
        // 查找路径
        // $active = \Route::current()->getActionName();
        // dump($active);

        // 获取用户信息
        $uid = session('uid');
        $users = User::find($uid);
        

        // 通过用户的信息查找角色
        $roles = $users->roles;
        // dd($roles);
        $pers = [];
        foreach($roles as $k => $role_id){
             //通过角色查找权限
            $rles = $role_id->pers;
            foreach($rles as $k => $v){
                $pers[] =$v->url;
            }
        }
        $urls = array_unique($pers);
        $active = \Route::current()->getActionName();


        // 判断 该用户有哪些权限
        if(in_array($active,$urls)){
            //如果角色有权限
            return $next($request);
        } else {
            //如果角色没有权限  提示页面  没有权限不能访问
            return redirect('/admin/remind');
        }
    }
}

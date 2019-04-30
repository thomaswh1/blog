<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\User;
use App\Model\Permission;
use App\Model\Role;

class HasRole
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
        //1.获取当前请求的路由  路由对应的控制器方法名
        $route = \Route::current()->getActionName();
//        dd($route);
//        "App\Http\Controllers\Admin\LoginController@index"
        //2.获取当前用户权限组
        $user = User::find(session()->get('user')->user_id);
//        2.1获取当前用户的角色

        $roles = $user->role;
        dd($roles);

        //存放权限的per_url
        $arr = [];
        //根据用户拥有的角色找对应的权限
        foreach($roles as $v)
        {
            $perms = $v->permission;
            foreach($perms as $perm){
                $arr[] = $perm->per_url;
            }
        }
//        dd($arr);
        //去掉重复权限
        $arr = array_unique($arr);
        //判断当前请求的路由对应控制器的方法名是否在当前用户拥有的权限列表中
        if(in_array($route,$arr)){
            return $next($request);
        }else{
            return redirect('noaccess');
        }

    }
}

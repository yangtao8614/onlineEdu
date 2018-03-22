<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;
class AdminLogin
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
        //Auth::guard('admin')->check();已经成功登录，则返回true;
        if(!Auth::guard('admin')->check()){
            //未登录状态；
            return redirect('admin/login');
        }
        //获取管理员的id;
        $id = Auth::guard('admin')->user()->id;

        if($id!=1){
            //排除掉后台首页控制器和登录控制器；
            if(getController_name()!='Index' && getController_name()!='Manager'){
                 //验证权限；
               //获取管理员的拥有的权限；
               $info =  DB::table('manager as m')->join('role as r','m.role_id','=','r.id')->
                            where('m.id',$id)->
                            select('priv_ac')->
                            first();
                $priv_ac = $info->priv_ac;
                //取出当前操作的权限（控制器和方法）
                $current_ac = getController_name().'-'.getAction_name();
                //echo $current_ac;exit;
                if(strpos($priv_ac,$current_ac)===false){
                    //没有权限；
                    exit('你无权操作');
                }
            }

        }
        return $next($request);
    }
}

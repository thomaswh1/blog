<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Crypt;
use App\Model\Homeuser;
use mysql_xdevapi\Session;


class LoginController extends Controller
{

    //登录
    public function login()
    {
         //返回页面
        return view('home.login');
    }
    public function dologin(Request $request)
    {

        //1.接收表单提交的数据
        $input = $request->except('_token');

        //2.表单验证
        //$validator = Validator::make('需要验证的表单数据','验证规则','错误提示信息');
        $rule=[
            'user_name' => 'required|between:4,18',
            'user_pass' => 'required|between:4,18|alpha_dash',
        ];
        $msg = [
            'user_name.required'=>'用户名必须输入',
            'user_name.between'=>'用户名长度必须在4-18位之间',
            'userpass.required'=>'密码必须输入',
            'user_pass.between'=>'密码长度必须在4-18位之间',
            'user_pass.alpha_dash'=>'密码必须是数字字母下划线',
        ];
        $validator = Validator::make($input, $rule,$msg);
        if ($validator->fails()) {
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }

        //3.验证是否有此用户（用户名，密码，验证码）
        $user = Homeuser::where('user_name',$input['user_name'])->first();
        if(!$user){
            return redirect('/login')-> with('errors','用户不存在');
        }
        if($input['user_pass'] != Crypt::decrypt($user->user_pass)){
            return redirect('/login')->with('errors','密码错误');
        }
        //4.保存用户信息到session
        session()->put('user',$user);
        //5.跳转到首页
       return redirect('/index');
    }

     //退出登录
    public function logout()
    {
        //清空session中的用户信息
        session()->flush();
        //跳转到登录页面
         return redirect('/index');
    }
}

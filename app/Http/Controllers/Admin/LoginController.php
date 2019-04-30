<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Org\code\Code;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Model\User;
use mysql_xdevapi\Session;

class LoginController extends Controller
{
    //后台登录页
    public function login()
    {
        return view('admin.login');
    }
    //验证码
    public function code()
    {
        $code = new Code();
        return $code->make();
    }
    //处理用户登录到方法

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doLogin(Request $request)
    {
    //1.接收表单提交的数据
        $input = $request->except('_token');

        //2.表单验证
        //$validator = Validator::make('需要验证的表单数据','验证规则','错误提示信息');
        $rule=[
            'username' => 'required|between:4,18',
            'password' => 'required|between:4,18|alpha_dash',
        ];
        $msg = [
            'username.required'=>'用户名必须输入',
            'username.between'=>'用户名长度必须在4-18位之间',
            'password.required'=>'密码必须输入',
            'password.between'=>'密码长度必须在4-18位之间',
            'password.alpha_dash'=>'密码必须是数字字母下划线',
        ];
        $validator = Validator::make($input, $rule,$msg);
        if ($validator->fails()) {
            return redirect('admin/login')
                ->withErrors($validator)
                ->withInput();
        }

        //3.验证是否有此用户（用户名，密码，验证码）
        if(strtolower($input['code']) != strtolower(session()->get('code'))){
            return redirect('admin/login')->with('errors','验证码错误');
        }
        $user = User::where('user_name',$input['username'])->first();
        if(!$user){
            return redirect('admin/login') -> with('errors','用户不存在');
        }
        if($input['password'] != Crypt::decrypt($user->user_pass)){
            return redirect('admin/login')->with('errors','密码错误');
        }
        //4.保存用户信息到session
        session()->put('user',$user);
        //5.跳转到后台首页
       return redirect('admin/index');

    }

    //加密算法
//    public function jiami(){
//        1.md5加密
//        $str = 'salt'.'123456';
//        return md5($str);
//        2.哈希加密
//        $str ='123456';
////        $str1 ='12345';
////        $hash = Hash::make($str);//加密
////        if(Hash::check($str1,$hash)){//解密
////            return '密码正确';
////        }else{
////            return '密码错误';
////        }
//        3.crypt加密
//        $str = '123456';
//        $crypt_str = Crypt::encrypt($str);
//        return $crypt_str;
//        if(Crypt::decrypt($crypt_str) == $str){
//            return '密码正确';
//        }
//    }

    //后台首页
    public function index()
    {
        return view('admin.index');
    }

    //后台欢迎页
    public function welcome()
    {
        return view('admin.welcome');
    }
    //后台退出登录
    public function logout()
    {
        //清空session中的用户信息
        session()->flush();
        //跳转到登录页面
         return redirect('admin/login');
    }
    //没有权限，对应的跳转
    public function noaccess()
    {
        return view('errors.noaccess');
    }
}

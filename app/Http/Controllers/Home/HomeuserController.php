<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Crypt;
use App\Model\Homeuser;

class HomeuserController extends Controller
{

 public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.zhuce');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1.接收表单提交的数据{"user_name":"qqq","user_pass":"qqq","phone":"qqq","email":"qqq"}
        $input = $request->except('_token');
       // // 2.进行表单验证
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
                return redirect('/homeuser/create')
                    ->withErrors($validator)
                    ->withInput();
            }
       //  //3.添加到数据库
         $pass = Crypt::encrypt($input['user_pass']);
         $res = Homeuser::create(['user_name'=>$input['user_name'],'user_pass'=>$pass,'phone'=>$input['phone'],'email'=>$input['email']]);

       //  //4.根据添加是否成功，给客户反馈json格式的反馈
        if($res){
            $data = [
                'status'=>0,
                'message'=>'注册成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'注册失败'
            ];
        }
        // 跳转登录页
        return redirect('/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

}

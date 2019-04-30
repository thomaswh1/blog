<?php

namespace App\Http\Controllers\Admin;


use App\Model\Permission;
use App\Model\Role;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    //    获取授权页面
    public function auth($id)
    {
        //获取当前用户
        $user = User::find($id);
        //获取所有的角色列表
        $perms = Role::get();
        //获取当前角色拥有的角色
        $own_perms = $user->role;
        //角色拥有的权限id
        $own_pers = [];
        foreach ($own_perms as $v){
            $own_pers[] = $v->id;
        }
        return view('admin.user.auth',compact('user','perms','own_pers'));
    }

    //处理授权的方法
    public function doAuth(Request $request)
    {
        $input = $request->except('_token');
        //删除当前用户已有的角色
        \DB::table('user_role')->where('user_id',$input['user_id'])->delete();
//        dd ($input);
        //添加新授予的角色
        if(!empty($input['role_id'])){
            foreach ($input['role_id'] as $v){
                \DB::table('user_role')->insert(['user_id'=>$input['user_id'],'role_id'=>$v]);
            }
        }
        return redirect('admin/user');
    }


    /**
     * Display a listing of the resource.请求列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //1.获取请求的参数
        $user = User::orderBy('user_id','asc')
            ->where(function($query) use($request){
                $username = $request->input('username');
                $email = $request->input('email');
                if(!empty($username)){
                    $query->where('user_name','like','%'.$username.'%');
                }
                if(!empty($email)){
                    $query->where('email','like','%'.$email.'%');
                }
            })
            ->paginate($request->input('num')?$request->input('num'):3);

//        $user = User::paginate(3);
        return view('admin.user.list',compact('user','request'));
    }

    /**
     * Show the form for creating a new resource.添加用户
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.执行添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1.接收表单提交的数据 email pass repass
//        return 111;
        $input = $request->all();
       // 2.进行表单验证

        //3.添加到数据库
         $username = $input['email'];
         $pass = Crypt::encrypt($input['pass']);
         $res = User::create(['user_name'=>$username,'user_pass'=>$pass,'email'=>$input['email']]);

        //4.根据添加是否成功，给客户反馈json格式的反馈
        if($res){
            $data = [
                'status'=>0,
                'message'=>'添加成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'添加失败'
            ];
        }
        return $data;

    }

    /**
     * Display the specified resource.显示一条用户
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);
        return view('admin.user.details',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.返回修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.执行修改操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //根据id获取要修改的记录
        $user = User::find($id);
        //2.获取要修改后的用户名
        $username = $request->input('user_name');
        $useremail = $request->input('email');
        $userphone = $request->input('phone');

        $user->user_name = $username;
        $user->email = $useremail;
        $user->phone = $userphone;

        $res = $user->save();
        if($res){
            $data = [
                'status'=>0,
                'message'=>'修改成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'修改失败'
            ];
        }
        return $data;
    }

    /**
     * Remove the specified resource from storage.执行删除操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        $res = $user->delete();
        if($res){
            $data = [
                'status'=>0,
                'message'=>'删除成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'删除失败'
            ];
        }
        return $data;

    }

    //删除所有选中用户
    public function delAll(Request  $request)
    {
        $input = $request->input('ids');
        $res = User::destroy($input);
        if($res){
            $data = [
                'status'=>0,
                'message'=>'删除成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'删除失败'
            ];
        }
        return $data;
    }

    //修改密码
    public function editpass($id)
    {
        $user = User::find($id);
        return view('admin.user.editpass',compact('user'));
    }
    //执行修改
    public function doEdit(Request $request)
    {
        //用户ID
        $id = $request->input('uid');
        $user = User::find($id);
        //数据库中用户原始密码
        $oldPass = Crypt::decrypt($user->user_pass);

        if($oldPass == $request->input('oldpass')){
            //原始密码正确,修改密码
            $user->user_pass = Crypt::encrypt($request->input('pass'));
            $res = $user->save();
            if($res){
                $data = [
                    'status'=>0,
                    'message'=>'修改成功'
                ];
            }else{
                $data = [
                    'status'=>1,
                    'message'=>'修改失败'
                ];
            }
        }else{
            //原始密码不正确
            $data = [
                'status'=>1,
                'message'=>'原始密码不正确'
            ];
        }
        return $data;
    }
}

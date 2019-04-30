<?php

namespace App\Http\Controllers\Admin;

use App\Model\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CateController extends Controller
{
    //修改排序的方法
    public function changeOrder(Request $request)
    {
        //获取传过来的值
        $input = $request->except('_token');
        //通过id获取当前分类
        $cate = Cate::find($input['cate_id']);
        //修改当前分类的排序值
        $res = $cate->update(['cate_order'=>$input['cate_order']]);
        if($res){
            $data = [
                'status'=>0,
                'msg'=>'排序成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'排序失败'
            ];
        }
        return $data;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $cates = Cate::get();
        $cates = (new Cate())->tree();
        return view('admin.cate.list',compact('cates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获一级类
        $cate = Cate::where('cate_pid',0)->get();

        return view('admin.cate.add',compact('cate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接受添加的分类数据
        $input = $request->except('_token');

        //表单验证
        //添加数据库中
        $res = Cate::create($input);

        //是否添加成功
        if($res)
        {
            $data = [
                'status'=>0,
                'message'=>'添加成功'
            ];
//            return redirect('admin/cate');
        }else{
            $data = [
                'status'=>1,
                'message'=>'添加失败'
            ];
//            return back();
        }
        return $data;
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
        //
        $cate = Cate::find($id);
        return view('admin.cate.edit',compact('cate'));
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
        //
        //根据id获取要修改的记录
        $cate = Cate::find($id);
        //2.获取要修改后的用户名
        $catename = $request->input('cate_name');
        $catetitle=$request->input('cate_title');

        $cate->cate_name = $catename;
        $cate->cate_title=$catetitle;
        $res = $cate->save();
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate = Cate::find($id);
        if($cate->cate_pid==0){
         //父级分类
            $data = [
                'status'=>1,
                'message'=>'删除失败，父类不能删除'
            ];
        }else{
            //子类直接删除
            $res = $cate->delete();
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
        }
        return $data;
    }
}

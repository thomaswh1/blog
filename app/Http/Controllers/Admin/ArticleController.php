<?php

namespace App\Http\Controllers\Admin;

use App\Model\Article;
use App\Model\Cate;
use Redis;
use Image;
//use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //文章上传
    public function upload(Request $request)
    {
        //获取上传文件
        $file = $request->file('photo');
        //判断文件是否有效
        if (!$file->isValid()){
            return response()->json(['ServerNo'=>'400','ResultData'=>'无效的上传文件']);
        }
        //获取源文件的扩展名
        $ext = $file->getClientOriginalExtension();//文件扩展名
        $newName = md5(time().rand(1000,9999)).'.'.$ext;//新文件名
        $path = public_path('uploads');

        //移动文件从临时目录到指定目录
//        if(!$file->move($path,$newName)){
//            return response()->json(['ServerNo'=>'400','ResultData'=>'上传文件失败']);
//        }

       $res = Image::make($file)->resize(100,100)->save($path.'/'.$newName);

        if($res){
            // 如果上传成功
            return response()->json(['ServerNo'=>'200','ResultData'=>$newName]);
        }else{
            return response()->json(['ServerNo'=>'400','ResultData'=>'上传文件失败']);
        }


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $article = Article::paginate(5);
        //获取所有分类
        $cates = (new Cate)->tree();

        //存放所有文章记录
//        $article = [];
//        $listkey = 'LIST:ARTICLE';
//        $hashkey = 'HASH:ARTICLE';
//        if(Redis::exists($listkey)){
//            //redis中存在要取的数据，直接返回
//                //存放所有要获取的文章id
//            $lists = Redis::lrange($listkey,0,-1);
//            foreach ($lists as $k=>$v){
//                $article[] = Redis::hgetall($hashkey.$v);
//            }
//        }else{
//            //连接数据库,获取数据
//            $article = Article::get()->toArray();
//            //将数据存入redis
//            foreach ($article as $k=>$v){
//                //将文章ID添加到listkey中
//                Redis::rpush($listkey,$v['art_id']);
//                //将文章添加到hashkey中
//                Redis::hmset($hashkey.$v['art_id'],$v);
//            }
//            //返回数据到客户端
//        }

        return view('admin.article.list',compact('article','cates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取所有分类
        $cates = (new Cate)->tree();
        return view('admin.article.add',compact('cates'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->except('_token','photo');
        $input['art_time'] = time();
//        return $input;
        $res = Article::create($input);
        //是否添加成功
        if($res)
        {
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
        $art = Article::find($id);
        $cates = (new Cate)->tree();
        return view('admin.article.edit',compact('art','cates'));
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
        $art = Article::find($id);
//       return $request["art_title"];
        //获取要修改后的
//        $artname = $request->input('user_name');
        if ($request['art_thumb'] != ''){
            $art->art_thumb=$request['art_thumb'];
        }
        $art->art_title = $request['art_title'];
        $art->art_editor=$request['art_editor'];
        $art->art_tag=$request['art_tag'];
        $art->art_description=$request['art_description'];
        $art->art_content=$request['art_content'];
        $art->art_time = time();
        $res = $art->save();
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
        //删除数据库中信息
        $art = Article::find($id);

        //删除图片
        //图片路径
        //删除图片

        $res = $art->delete();

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

    //删除所有选中
    public function delAll(Request  $request)
    {
        $input = $request->input('ids');
        $res = Article::destroy($input);
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

    //推荐、
    public function tuijian($id){
        //获取文章信息
        $art = Article::find($id);
        if (!$art->art_status){
            $art->art_status = 1;
            $res = $art->save();
            if($res){
                $data = [
                    'status'=>0,
                    'message'=>'推荐成功'
                ];
            }else{
                $data = [
                    'status'=>1,
                    'message'=>'推荐失败'
                ];
            }
        }else{
            $art->art_status = 0;
            $res = $art->save();
            if($res){
                $data = [
                    'status'=>0,
                    'message'=>'取消推荐成功'
                ];
            }else{
                $data = [
                    'status'=>1,
                    'message'=>'取消推荐失败'
                ];
            }
        }
        return $data;

    }

}

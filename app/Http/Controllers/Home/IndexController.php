<?php

namespace App\Http\Controllers\Home;

use App\Model\Comment;
use App\Model\Article;
use App\Model\Cate;
use App\Model\Collect;
use App\Model\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class IndexController extends CommonController
{
    //前台首页
    public function index()
    {
        //从网站配置表中获取网站状态conf_id=3
        $config = Config::find($id=3);
            if($config->conf_content == 1){
                //前端网站开启

                //获取相关二级类及文章
                $cate_arts = Cate::where('cate_pid','<>',0)->with('article')->get();
                return view('home.index',compact('cate_arts'));

            }else{
                return view('/errors/close');
            }



    }

    //列表页
    public function lists($id)
    {
        //获取相关类
        $cate = Cate::find($id);
        if($cate){
            //获取相关文章
            $cate_arts = Cate::where('cate_id','=',$id)->with('article')->paginate(3);
            return view('home.lists',compact('cate','cate_arts'));
        }else{
            return  back();
        }

    }

    //详情页
    public function detail($id)
    {
        //文章,分类，评论
        $art = Article::find($id);
        $cate = Cate::find($art['cate_id']);
        $comment = Comment::where('post_id',$id)->get();
        // dd($comment);
        if ($art){
            return view('home.detail',compact('art','cate','comment'));
        }else{
            return back();
        }
    }

    //收藏
    public function collect(Request $request)
    {
        //获取数据
        $uid = $request->input('uid');
        $artid = $request->input('artid');
        $act = $request->input('act');

        //判断当前操作  收藏还是取消收藏
        switch ($act)
        {
            //收藏
            case 'add':
                //判断是否已经收藏过
                $collect = Collect::where([
                    ['uid','=',$uid],
                    ['art_id','=',$artid]
                ])->get();
                if($collect->isEmpty()){
                   //未被收藏
                    //文章表收藏字段加1
                    Article::where('art_id',$artid)->increment('art_collect',1);
                    $res = Collect::create(['uid'=>$uid,'art_id'=>$artid]);

                    if ($res){
                        return response()->json(['status'=>0,'msg'=>'已经收藏']);
                    }else{
                        return response()->json(['status'=>1,'msg'=>'收藏失败']);
                    }
                }else{
                    return response()->json(['status'=>0,'msg'=>'已经收藏']);
                }
                break;

            //取消收藏
            case 'remove':
                $collect = Collect::where([
                    ['uid','=',$uid],
                    ['art_id','=',$artid]
                ])->first();
                if(!empty($collect)) {
                    //文章收藏量减1
                    Article::where('art_id',$artid)->decrement('art_collect',1);
                    //取消收藏
                    $res = $collect->delete();
                    if ($res){
                        return response()->json(['status'=>0,'msg'=>'请收藏']);
                    }else{
                        return response()->json(['status'=>1,'msg'=>'取消收藏失败']);
                    }
                }else{
                    return response()->json(['status'=>0,'msg'=>'请收藏']);
                }
                break;
        }

    }

    //喜欢
    public function love(Request $request)
    {
        $artid = $request->input('artid');
        $res = Article::where('art_id',$artid)->increment('art_love',1);
        if ($res){
            return response()->json(['status'=>0,'msg'=>'已经喜爱']);
        }else{
            return response()->json(['status'=>1,'msg'=>'喜爱失败']);
        }

    }

    //查找 搜索  从文章表中的 文章标题art_title 中查找
    public function search(Request $request)
    {
        // return $request['s'];       //{"s":"asdf"}

        $ser = $request['s'];
        $art = Article::get();
        $cate = Cate::get();
        
        $p = Article::where('art_title','like','%'.$ser.'%')->get();
       
        
        return view('home.search',compact('p','cate'));
    }

    //留言
    public function liuyan(Request $request)
    {
        // dd($request);
        // return $request;
        //提交的信息 {"comment":"\u6309\u65f6","comment_post_ID":"5136","comment_parent":"0","submit":null}
        if (empty($request['nickname'])){
             $data = [
                'status'=>1,
                'message'=>'请先登录'
            ];
        }else{
             //写入数据库
            $res = Comment::create(['parent_id'=>$request['parent_id'],'nickname'=>$request['nickname'],'content'=>$request['content'],'create_time'=>time(),'post_id'=>$request['post_id']]);
            
            if($res){
                $data = [
                    'status'=>0,
                    'message'=>'评论成功'
                ];
            }else{
                 $data = [
                    'status'=>1,
                    'message'=>'评论失败'
                ];
            }
        }
        return $data;
  
    }

}

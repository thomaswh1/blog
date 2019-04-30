<?php

namespace App\Http\Controllers\Home;

use App\Model\Cate;
use App\Model\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    //
    public function __construct()
    {
        $cate = Cate::get();
        //存放一级类
        $cateone = [];
        //存放二级类
        $catetwo = [];

        foreach ($cate as $k=>$v){
            //取出一级类
            if($v->cate_pid == 0)
            {
                $cateone[$k] = $v;
                //获取二级类
                foreach ($cate as $m=>$n){
                    if($v->cate_id == $n->cate_pid){
                        $catetwo[$k][$m]=$n;
                    }
                }
            }
        }
        //获取友情链接
        $links = Link::get();
//        dd($links);
//        dd($cateone);
//        dd($catetwo);
        view()->share('cateone',$cateone);
        view()->share('catetwo',$catetwo);
        view()->share('links',$links);
    }
}

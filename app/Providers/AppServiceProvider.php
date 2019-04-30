<?php

namespace App\Providers;

use App\Model\Cate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //获取所有的分类
//        $cate = Cate::get();
//        //存放一级类
//        $cateone = [];
//        //存放二级类
//        $catetwo = [];
//
//        foreach ($cate as $k=>$v){
//            //取出一级类
//            if($v->cate_pid == 0)
//            {
//                $cateone[$k] = $v;
//                //获取二级类
//                foreach ($cate as $m=>$n){
//                    if($v->cate_id == $n->cate_pid){
//                        $catetwo[$k][$m]=$n;
//                    }
//                }
//            }
//        }
////        dd($cateone);
////        dd($catetwo);
//        view()->share('cateone',$cateone);
//        view()->share('catetwo',$catetwo);

    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

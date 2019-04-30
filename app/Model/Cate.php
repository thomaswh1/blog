<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //1.关联的数据表
    public $table = 'category';

    //2.主键
    public $primaryKey = 'cate_id';

    //3.允许批量操作的字段
//    public $fillable = ['user_name','user_pass','phone'];
    public $guarded = [];
//    4.是否维护crated_at和updated_at字段
    public $timestamps = false;

    //格式化分类数据
    public function tree()
    {
        //获取所有分类
        $cates = $this->orderBy('cate_order','asc')->get();//asc指定列按升序排列  desc指定列按降序排列

        //格式化
        return $this->getTree($cates);
    }

    public function getTree($category)
    {
        //存放最终排完序的数据
        $arr = [];
        //排序
        //先获取一级类
        foreach ($category as $k=>$v){
            //一级类
            if($v->cate_pid==0){
                $arr[] = $v;
                //获取一级类下的二级类
                foreach($category as $m=>$n){
                    if($v->cate_id == $n->cate_pid){
                        //给分类名称添加缩进
                        $n->cate_name = '|----'.$n->cate_name;
                        $arr[] = $n;
                    }
                }
            }
        }
        return $arr;
    }
    //定义和文章表的关联属性
    public function article()
    {
        return $this->hasMany('App\Model\Article','cate_id','cate_id');
    }

}

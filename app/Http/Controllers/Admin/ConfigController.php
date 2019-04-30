<?php

namespace App\Http\Controllers\Admin;

use App\Model\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ConfigController extends Controller
{

    //将网站配置表中的网站配置数据写入config/webconfig.php文件中
    public function putcontent()
    {
        //1.从网站配置表中获取数据
        $content = Config::pluck('conf_content','conf_name')->all();
        //2.准备要写入的内容
//        dd($content);
        $str = '<?php return '.var_export($content,true).';';

        //3.将内容写入webconfig.php文件
        file_put_contents(config_path().'/webconfig.php',$str);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $config = Config::get();
        //格式化返回的数据
        foreach ($config as $v){
            switch ($v->field_type){
                case 'input':
                    $v->conf_contents = '<input value="'.$v->conf_content.'" type="text" name="conf_content[]" class="layui-input">';
                    break;
                case 'textarea':
                    $v->conf_contents = '<textarea class="layui-textarea" name="conf_content[]">'.$v->conf_content.'</textarea>';
                    break;
                case 'radio':
                    // field_value值   1|开启,0|关闭
                    $str = ''; //存放最终的结果
                    $arr = explode(',',$v->field_value);//[0=>"1|开启",1=>"0|关闭"]
                        foreach ($arr as $n){
                            $a = explode('|',$n);//[0=>"1",1=>"开启"]
                            if($v->conf_content == $a[0]){
                                $str .= '<input type="radio" name="conf_content[]" value="'.$a[0].'" title="'.$a[1].'" checked>'.$a[1].'&nbsp;&nbsp;&nbsp;&nbsp;';
                            }else{
                                $str .= '<input type="radio" name="conf_content[]" value="'.$a[0].'" title="'.$a[1].'" >'.$a[1].'&nbsp;&nbsp;&nbsp;&nbsp;';
                            }
                        }
                    $v->conf_contents = $str;
                    break;
            }
        }
        return view('admin.config.list',compact('config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.config.add');
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
        //1.接受数据 per_name per_path
        $input = $request->except('_token');
        // 2.进行表单验证
        //3.添加到数据库
        if ( !is_numeric($input['conf_order']) ){
            $data = [
                'status'=>1,
                'message'=>'添加失败，排序值为非数字类型'
            ];
            return $data;
        }
        if ($input['field_type']=='radio'){
            $input['conf_content']=0;
            $input['field_value']='1|开启,0|关闭';
        }
        $res = Config::create($input);

        //4.根据添加是否成功，给客户反馈json格式的反馈
        if($res){
            $this->putcontent();
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
        $config = Config::find($id);
        return view('admin.config.edit',compact('config'));
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
        $conf = Config::find($id);
        //2.获取要修改后的用
        $conf['conf_title'] = $request['conf_title'];
        $conf['conf_name'] = $request['conf_name'];
        $conf['conf_content'] = $request['conf_content'];
        $conf['field_type'] = $request['field_type'];
        $conf['conf_order'] = $request['conf_order'];
        $conf['conf_tips'] = $request['conf_tips'];
        if($conf['field_type']=='radio'){
            $conf['field_value']='1|开启,0|关闭';
        }
        $res = $conf->save();
        if($res){
            $this->putcontent();
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
        //
        $conf = Config::find($id);
        $res = $conf->delete();
        if($res){
            $this->putcontent();
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

    //批量修改网站配置
    public function changeContent(Request $request)
    {
        $input = $request->except('_token');
//        dd($input);
        DB::beginTransaction();
        try{
            foreach ($input['conf_id'] as $k=>$v){
                DB::table('config')->where('conf_id',$v)->update(['conf_content'=>$input['conf_content'][$k]]);
            }
            DB::commit();
            $this->putcontent();
            return redirect('admin/config');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }



}

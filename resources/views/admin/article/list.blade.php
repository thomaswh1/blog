<html class="x-admin-sm">
  <head>
    <meta charset="UTF-8">
    <title>文章列表页</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />

  @include('admin.public.styles')
  @include('admin.public.script')

    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>文章列表</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">&#xe666;</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">

      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加文章','{{url('admin/article/create')}}',600,400)"><i class="layui-icon"></i>添加</button>
        {{--<span class="x-right" style="line-height:40px">共有数据：88 条</span>--}}
      </xblock>
      <table class="layui-table x-admin">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>文章标题</th>
            <th>作者</th>
            <th>缩略图</th>
            <th>文章分类</th>
            <th>描述</th>
            <th>发布时间</th>
            <th>状态</th>
            <th>操作</th></tr>
        </thead>
        <tbody>
        @foreach ($article as $m=>$v)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{$v->art_id}}'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$v->art_title}}</td>
            <td>{{$v->art_editor}}</td>
            <td><img src="{{$v->art_thumb}}" alt="" style="width: 50px;"></td>
            <td>
              @foreach($cates as $k=>$n)
                @if($n->cate_id==$v->cate_id)
                  {{$n->cate_name}}
                @endif
              @endforeach</td>
            <td style="width:25%">{{$v->art_description}}</td>
            <td>{{date('Y-m-d ',$v->art_time)}}</td>
            <td>
              <span class="layui-btn layui-btn-normal layui-btn-mini">
              @if($v->art_status)
                已推荐
              @else
                未推荐
              @endif
              </span>
            </td>
            <td class="td-manage">
              <a title="编辑"  onclick="x_admin_show('文章修改','{{url('admin/article/'.$v->art_id.'/edit')}}',600,400)" href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
              </a>
              <a title="推荐" onclick="member_tuijian(this,{{$v->art_id}})" href="javascript:;">
                <i class="layui-icon">&#xe67a;</i>
              </a>

              <a title="删除" onclick="member_del(this,{{$v->art_id}})" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="page">
        {!! $article->render() !!}
      </div>

    </div>
    <script>
      layui.use('laydate', function(){
        var laydate = layui.laydate;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

      /*用户-推荐*/
      function member_tuijian(obj,id){
        layer.confirm('确认要操作吗？',function(index){
          $.post('/admin/article/tuijian/'+id,{"_method":"get"},function(data){
            console.log(data);
            if(data.status==0){
              window.location.reload()
              layer.msg(data.message,{icon:6,time:1000});
            }else{
              layer.msg(data.message,{icon:5,time:1000});
            }
          })

        });
      }

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
            $.post('/admin/article/'+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){
              // console.log(data);
              if(data.status==0){
                $(obj).parents("tr").remove();
                layer.msg(data.message,{icon:6,time:1000});
              }else{
                layer.msg(data.message,{icon:5,time:1000});
              }
            })

          });
      }

      function delAll (argument) {
        //获取要批量删除的用户id
        var ids = [];
        $(".layui-form-checked").not('.header').each(function(i,v){
          var u= $(v).attr('data-id');
          ids.push(u);
          console.log(ids);
        });

        // var data = tableCheck.getData();

        layer.confirm('确认要删除吗？',function(index){
          $.get('/admin/article/del',{'ids':ids},function(data){
            console.log(data);
            if(data.status==0){
              // $(obj).parents("tr").remove();
              $(".layui-form-checked").not('.header').parents('tr').remove();
              layer.msg(data.message,{icon:6,time:1000});
            }else{
              layer.msg(data.message,{icon:5,time:1000});
            }
          });
            //捉到所有被选中的，发异步进行删除
            // layer.msg('删除成功', {icon: 1});

        });
      }

    </script>

  </body>

</html>
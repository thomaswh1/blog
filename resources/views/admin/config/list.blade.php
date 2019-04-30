<html class="x-admin-sm">
  <head>
    <meta charset="UTF-8">
    <title>网站配置列表页</title>
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
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">&#xe666;</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">

      </div>
      <form action="{{url('admin/config/changecontent')}}" method="post">
      <table class="layui-table x-admin ">
        <thead>
          <tr>
            <th>ID</th>
            <th>网站标题</th>
            <th>名称</th>
            <th>内容</th>
            <th>说明</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($config as $v)
          <tr>
            <td>{{$v->conf_id}}</td>
            <td>{{$v->conf_title}}</td>
            <td>{{$v->conf_name}}</td>
            <input type="hidden" name="conf_id[]" value="{{$v->conf_id}}">
            <td style="width: 400px;">{!! $v->conf_contents !!}</td>
            <td>{{$v->conf_tips}}</td>
            <td width="50px">
              <a title="修改"  onclick="x_admin_show('修改','{{url('admin/config/'.$v->conf_id.'/edit')}}',600,400)" href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
              </a>
              <a title="删除" onclick="member_del(this,{{$v->conf_id}})" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
          @endforeach
        <tr>
          <td colspan="6">
            {{csrf_field()}}
            <button class="layui-btn layui-btn-danger" lay-filter="add" >批量修改</button>
          </td>
        </tr>
        </tbody>
      </table>
      </form>

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

      /*角色-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
            $.post('/admin/config/'+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){
              console.log(data);
              if(data.status==0){
                $(obj).parents("tr").remove();
                layer.msg(data.message,{icon:6,time:1000});
              }else{
                layer.msg(data.message,{icon:5,time:1000});
              }
            })

          });
      }

    </script>

  </body>

</html>
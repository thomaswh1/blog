<!DOCTYPE html>
<html class="x-admin-sm">
  
  <head>
    <meta charset="UTF-8">
    <title>友情链接修改</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <div class="x-body">
        <form class="layui-form">
          <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>链接名称
              </label>
              <div class="layui-input-inline">
                  <input type="hidden" name="uid" value="{{$link->link_id}}">
                  <input type="text" id="L_username" value="{{$link->link_name}}" name="link_name" required="" lay-verify="nikename"
                  autocomplete="off" class="layui-input">
              </div>
          </div>

            <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>链接标题
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_username" value="{{$link->link_title}}" name="link_title" required="" lay-verify="nikename"
                         autocomplete="off" class="layui-input">
              </div>
            </div>

            <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>链接路由
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_username" value="{{$link->link_url}}" name="link_url" required="" lay-verify="nikename"
                         autocomplete="off" class="layui-input">
              </div>
            </div>



          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="edit" lay-submit="">
                  修改
              </button>
          </div>
      </form>
    </div>

    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;

          //监听提交
          form.on('submit(edit)', function(data){
              var uid = $("input[name='uid']").val();
            //发异步，把数据提交给php
              $.ajax({
                      type:'PUT',
                      url:'/admin/link/'+uid,
                      dataType:'json',
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      data:data.field,
                      success:function(data){
                          // 弹层提示添加成功，并刷新父页面
                          console.log(data);
                          if(data.status == 0){
                              layer.alert(data.message,{icon:6},function () {
                                    parent.location.reload(true);
                              })
                          }else {
                              layer.alert(data.message, {icon: 5});
                          }
                      },
                      error:function(){
                          //返回错误信息

                      },

                  });
            // layer.alert("增加成功", {icon: 6},function () {
            //     //关闭当前frame
            //     x_admin_close();
            //
            //     // 可以对父窗口进行刷新
            //     x_admin_father_reload();
            // });
            return false;
          });
          
          
        });
    </script>


  </body>

</html>
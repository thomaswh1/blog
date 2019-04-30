<!DOCTYPE html>
<html class="x-admin-sm">
  
  <head>
    <meta charset="UTF-8">
    <title>文章添加</title>
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
        <form class="layui-form" id="art_form">
            {{csrf_field()}}
          <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>文章分类
              </label>
              <div class="layui-input-inline">
                  <select name="cate_id" >
                      @foreach($cates as $v)
                            <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
                      @endforeach
                  </select>
              </div>
          </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">
                    <span class="x-red">*</span>文章标题
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_catetitle" name="art_title" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">
                    <span class="x-red">*</span>文章作者
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_username" name="art_editor" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item ">
                <label for="L_pass" class="layui-form-label">缩略图</label>
                <div class="layui-input-block layui-upload">
                    <input type="hidden" id="img1" class="hidden" name="art_thumb" value="">
                    <button type="button" class="layui-btn " id="test7">
                        <i class="layui-icon">&#xe67c;</i>上传图片
                    </button>
                    <input type="file" name="photo" id="photo_upload" style="display: none">
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label"></label>
                <div class="layui-input-block">
                    <img src="" alt="" id="art_thumb_img" style="width:50px">
                </div>
            </div>

            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">
                    <span class="x-red">*</span>关键词
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_username" name="art_tag" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">
                    <span class="x-red">*</span>描述
                </label>
                <div class="layui-input-inline">
                    <textarea name="art_description" id="" cols="30" rows="10" class="layui-textarea"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">
                    <span class="x-red">*</span>文章内容
                </label>
                <div class="layui-input-inline">

                    {{--百度富文本编辑器start--}}
                        <!-- 配置文件 -->
                        <script type="text/javascript" src="/utf8-php/ueditor.config.js"></script>
                        <!-- 编辑器源码文件 -->
                        <script type="text/javascript" src="/utf8-php/ueditor.all.js"></script>
                        <script type="text/javescript" charset="utf-8" src="/utf8-php/lang/zh-cn/zh-cn.js"></script>
                        <!-- 加载编辑器的容器 -->
                        <script id="container" name="art_content" type="text/plain" style="width: 800px;height: 300px;">

                        </script>
                        <!-- 实例化编辑器 -->
                        <script >
                            var ue = UE.getEditor('container');
                        </script>
                   {{--百度富文本编辑器end--}}
                    {{--markdown编辑器--}}

                    {{--markdown编辑器--}}

                </div>
            </div>

          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  增加
              </button>
          </div>
      </form>
    </div>

    <script>
        layui.use(['form','layer','upload'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
          var upload = layui.upload;

          // 文件上传
          $('#test7').on('click',function(){
              $('#photo_upload').trigger('click');
              $('#photo_upload').on('change',function(){
                  var obj = this;

                  var formData = new FormData($('#art_form')[0]);
                  $.ajax({
                      url:'/admin/article/upload',
                      type: 'post',
                      data:formData,
                      processData:false,
                      contentType:false,
                      success:function (data) {
                          console.log(data);
                          if(data['ServerNo']=='200'){
                              //如果成功
                              $('#art_thumb_img').attr('src','/uploads/'+data['ResultData']);
                              $('input[name=art_thumb]').val('/uploads/'+data['ResultData']);
                              $(obj).off('change');
                          }else{
                              //如果失败
                              alert(data['ResultData']);
                          }
                      },
                      error:function(XMLHttpRequest,textStatus,errorThrown){
                          // console.log(0);
                          var number = XMLHttpRequest.status;
                          var info = "错误号"+number+"文件上传失败！";
                          // $('#pic').attr('src','/file.png');
                          alert(info);
                      },
                      async:true
                  })

              })
          });

          //图片上传
          //   var uploadInst = upload.render(
          //   //设定文件大小限制
          //   upload.render({
          //       elem: '#test7'
          //       ,url: '/upload/'
          //       ,size: 60 //限制文件大小，单位 KB
          //       ,done: function(res){
          //           console.log(res)
          //       }
          //   })

          //监听提交
          form.on('submit(add)', function(data){
            //发异步，把数据提交给php
              $.ajax({
                      type:'POST',
                      url:'/admin/article',
                      dataType:'json',
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      data:data.field,
                      success:function(data){
                          // 弹层提示添加成功，并刷新父页面
                          // console.log(data);
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

            return false;
          });
          
          
        });
    </script>


  </body>

</html>
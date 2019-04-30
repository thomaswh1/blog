<!DOCTYPE html>
<html class="x-admin-sm">

  <head>
    <meta charset="UTF-8">
    <title>角色授权</title>
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
    <form class="layui-form" action="{{url('admin/role/doauth')}}" method="post">
        {{csrf_field()}}
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>角色名称
            </label>
            <div class="layui-input-inline">
                <input type="hidden" name="role_id" value="{{$role->id}}">
                <input type="text" id="L_username" value="{{$role->role_name}}" disabled="" name="role_name" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>权限列表
            </label>
            <div class="layui-input-inline" style="width:600px;">
                @foreach ($perms as $v)
                    @if(in_array($v->id,$own_pers))
                        <input type="checkbox" checked name="permission_id[]" title="{{$v->per_name}}" value="{{$v->id}}">
                    @else
                        <input type="checkbox" name="permission_id[]" title="{{$v->per_name}}" value="{{$v->id}}">
                    @endif
                @endforeach
            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="add" lay-submit="">
                授权
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
        form.on('submit(add)', function(data){

            // return false;

        });
    });
</script>


</body>

</html>
<!-- 顶部开始 -->
<div class="container">
    <div class="logo"><a href="#">blog后台管理系统</a></div>
    <div class="left_open">
        <i title="展开左侧栏" class="iconfont">&#xe699;</i>
    </div>
    {{--<ul class="layui-nav left fast-add" lay-filter="">--}}
        {{--<li class="layui-nav-item">--}}
            {{--<a href="javascript:;">+新增</a>--}}
            {{--<dl class="layui-nav-child"> <!-- 二级菜单 -->--}}
                {{--<dd><a onclick="x_admin_show('资讯','https://www.baidu.com')"><i class="iconfont">&#xe6a2;</i>资讯</a></dd>--}}
                {{--<dd><a onclick="x_admin_show('图片','https://www.baidu.com')"><i class="iconfont">&#xe6a8;</i>图片</a></dd>--}}
                {{--<dd><a onclick="x_admin_show('用户','https://www.baidu.com')"><i class="iconfont">&#xe6b8;</i>用户</a></dd>--}}
                {{--<dd><a onclick="x_admin_add_to_tab('在tab打开','https://www.baidu.com',true)"><i class="iconfont">&#xe6b8;</i>在tab打开</a></dd>--}}
            {{--</dl>--}}
        {{--</li>--}}
    {{--</ul>--}}
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">用户</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
                <dd><a href="{{url('admin/logout')}}">切换帐号</a></dd>
                <dd><a href="{{url('admin/logout')}}">退出</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item to-index"><a href="{{url('/index')}}">前台首页</a></li>
    </ul>

</div>
<!-- 顶部结束 -->
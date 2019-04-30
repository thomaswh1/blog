<!DOCTYPE html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />

        @include('admin.public.styles')

    </head>
    <body>
    <div class="x-body">
        <blockquote class="layui-elem-quote">欢迎管理员：
            <span class="x-red">{{session()->get('user')->user_name}}</span>！当前时间:{{date('Y-m-d H:i:s')}}
            {{--<a onclick="parent.x_admin_add_to_tab('在tab打开','https://www.163.com',true)" style="color: red" href="javascript:;">在tab打开</a>--}}
        </blockquote>
        <fieldset class="layui-elem-field">
            <legend>数据统计</legend>
            <div class="layui-field-box">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body">
                            <div class="layui-carousel x-admin-carousel x-admin-backlog" lay-anim="" lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 90px;">
                                <div carousel-item="">
                                    <ul class="layui-row layui-col-space10 layui-this">
                                        <li class="layui-col-xs2">
                                            <a href="javascript:;" class="x-admin-backlog-body">
                                                <h3>文章数</h3>
                                                <p>
                                                    <cite>66</cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs2">
                                            <a href="javascript:;" class="x-admin-backlog-body">
                                                <h3>会员数</h3>
                                                <p>
                                                    <cite>12</cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs2">
                                            <a href="javascript:;" class="x-admin-backlog-body">
                                                <h3>回复数</h3>
                                                <p>
                                                    <cite>99</cite></p>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="layui-elem-field">
            <legend>系统信息</legend>
            <div class="layui-field-box">
                <table class="layui-table">
                    <tbody>
                        {{--<tr>--}}
                            {{--<th>xxx版本</th>--}}
                            {{--<td>1.0.180420</td></tr>--}}
                        <tr>
                            <th>服务器地址</th>
                            <td>{{$_SERVER['SERVER_ADDR']}}</td></tr>
                        <tr>
                            <th>操作系统</th>
                            <td>{{php_uname()}}</td></tr>
                            <th>PHP版本</th>
                            <td> {{PHP_VERSION}}</td></tr>
                        <tr>
                            <th>PHP运行方式</th>
                            <td>{{php_sapi_name()}}</td></tr>
                        <tr>
                            <th>MYSQL版本</th>
                            <td>5.7.14</td></tr>
                        {{--<tr>--}}
                            {{--<th>请求页面时通信协议的名称和版本</th>--}}
                            {{--<td>{{$_SERVER['SERVER_PROTOCOL']}}</td></tr>--}}
                        <tr>
                            <th>上传附件限制</th>
                            <td>{{get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许" }}</td></tr>
                        <tr>
                            <th>执行时间限制</th>
                            <td>{{get_cfg_var("max_execution_time")."秒 "}}</td></tr>
                        {{--<tr>--}}
                            {{--<th>剩余空间</th>--}}
                            {{--<td>86015.2M</td></tr>--}}
                    </tbody>
                </table>
            </div>
        </fieldset>
        <fieldset class="layui-elem-field">
            <legend>开发团队</legend>
            <div class="layui-field-box">
                <table class="layui-table">
                    <tbody>
                    <tr>
                        <th>开发者</th>
                        <td>李文华(1986595856@qq.com)</td>
                    </tr>
                        {{--<tr>--}}
                            {{--<th>版权所有</th>--}}
                            {{--<td>xuebingsi(xuebingsi)--}}
                                {{--<a href="http://x.xuebingsi.com/" class='x-a' target="_blank">访问官网</a></td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<th>开发者</th>--}}
                            {{--<td>马志斌(113664000@qq.com)</td>--}}
                        {{--</tr>--}}
                    </tbody>
                </table>
            </div>
        </fieldset>
        <blockquote class="layui-elem-quote layui-quote-nm">感谢layui,百度Echarts,jquery,本系统由<a href="http://x.xuebingsi.com/" class='x-a' target="_blank">x-admin</a>提供技术支持。</blockquote>
    </div>
        {{--<script>--}}
        {{--var _hmt = _hmt || [];--}}
        {{--(function() {--}}
          {{--var hm = document.createElement("script");--}}
          {{--hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";--}}
          {{--var s = document.getElementsByTagName("script")[0]; --}}
          {{--s.parentNode.insertBefore(hm, s);--}}
        {{--})();--}}
        {{--</script>--}}
    </body>
</html>
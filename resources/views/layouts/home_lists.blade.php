<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- 引入页面描述和关键字模板 -->
    <title>@yield('title')</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    @include('home.public.styles')
    @include('home.public.script')


</head>
<body id="wrap" class="archive category category-talk category-154">
<!-- Nav -->
<!-- Moblie nav-->
<div id="body-container">

    <!-- /.Moblie nav -->
@include('home.public.navmenu')
<!-- /.Moblie nav -->

    <section id="content-container" style="background:#f1f4f9; ">

    {{--header start--}}
    @include('home.public.header')
    {{--header end--}}

    {{--banner--}}
    @include('home.public.listbanner')
    {{--banner--}}

    <!-- Header Banner -->
        <!-- /.Header Banner -->
        <!-- Main Wrap -->
            @section('main-wrap')

                {{--右侧边栏 start--}}
                @include('home.public.aside')
                {{--右侧边栏 end--}}

            @show
        <!--/.Main Wrap -->

        {{--底部 start--}}
        @include('home.public.footer')
        {{--底部 end--}}

    </section>
</div>

{{--登录--}}
@include('home.public.signin')
{{--登录--}}

<!-- /.Footer Nav Wrap -->
@include('home.public.footjs')
<!-- /.Footer Nav Wrap -->

</body>
</html>
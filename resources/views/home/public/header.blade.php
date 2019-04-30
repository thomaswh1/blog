<header class="header-wrap" id="nav-scroll">
    <div class="nav-wrap">
        <div class="logo-title">
            <a href="{{url('/index/')}}" alt="Blog" title="Blog"> 文章 Blog</a>
        </div>
        <!-- Toggle menu -->
        <div class="toggle-menu">
            <i class="fa fa-bars"></i>
        </div>
        <!-- /.Toggle menu -->
        <!-- Search button -->
        <div class="search-btn-click">
            <i class="fa fa-search"></i>
            <div class="header-search-slide">
                <form method="get" id="searchform-slide" class="searchform" action="{{url('/search/')}}" role="search">
                    <input type="search" class="field" name="s" value="" placeholder="请输入文章题目" required="" />
                </form>
            </div>
        </div>
        <!-- /.Search button -->
        <!-- Login status -->
        <div id="login-reg">
            @if(empty(session()->get('user')))   
            <a href="{{url('/login')}}" class="btn btn-primary user-login">登录</a>
            <a href="{{url('/homeuser/create')}}" class="btn btn-primary user-reg">注册</a>
            @else
            <a href="#" class="btn btn-primary">{{session()->get('user')->user_name}}</a>
            <a href="{{url('/hlogout')}}" class="btn btn-primary ">退出登录</a>
           @endif
            <!-- <form action="{{url('/loge')}}" method="post">
                <button data-sign="0" class="btn btn-primary user-login" >登录</button>
                <button data-sign="1" class="btn btn-success user-reg">注册</button>
            </form> -->
            <!-- <span data-sign="0" id="user-login" class="user-login ie_pie only-login"> 登录注册</span> -->
        </div>
        <!-- /.Login status -->
        <!-- Focus us -->
        <div id="focus-us">
            联系我
            <div id="focus-slide" class="ie_pie">

                <div class="focus-title">
                    联系我
                </div>
                <p class="focus-content" style="line-height: 20px;margin-bottom: 10px;">  
                    <a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=DD01NDo5NTk0OTpMfX0ib2Nh" style="text-decoration:none;">
                    <span><i class="fa fa-envelope"></i>发送邮件</span></a>
                </p>

            </div>
        </div>
        <!-- /.Focus us -->
        <!-- Menu Items Begin -->
        <nav id="primary-navigation" class="site-navigation primary-navigation " role="navigation">
            <div class="menu-%e9%a1%b6%e9%83%a8%e8%8f%9c%e5%8d%95-container">
                <ul id="menu-%e9%a1%b6%e9%83%a8%e8%8f%9c%e5%8d%95" class="nav-menu">
                    <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-4324"><a href="{{url('/index/')}}">首页</a></li>

                    @foreach($cateone as $k=>$v)
                    <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-4304"><a href="{{url('/lists/'.$v->cate_id)}}">{{$v->cate_name}}</a>
                        @if(!empty($catetwo[$k]))
                        <ul class="sub-menu">
                            @foreach($catetwo[$k] as $m=>$n)
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-4310"><a href="{{url('/lists/'.$n->cate_id)}}">{{$n->cate_name}}</a></li>
                            @endforeach
                        </ul>
                            @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </nav>
        <!-- Menu Items End -->
    </div>
    <div class="clr"></div>
    <div class="site_loading"></div>
</header>
<div class="hidefixnav"></div>
<!-- End Nav -->
<script type="text/javascript">
    $('.site_loading').animate({'width':'33%'},50);  //第一个进度节点
</script>
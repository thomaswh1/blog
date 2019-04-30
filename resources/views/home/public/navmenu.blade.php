<aside id="navmenu-mobile">
    <div id="navmenu-mobile-wraper">
        <div class="mobile-login-field">
            <div id="login-box-mobile">
                <div class="login-box-mobile-form">
                    <a href="{{url('/login')}}" class="btn btn-primary user-login">登录</a>
            <a href="{{url('/homeuser/create')}}" class="btn btn-primary user-reg">注册</a>
                </div>
            </div>
        </div>
        <ul id="menu-mobile" class="menu-mobile">
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
</aside>
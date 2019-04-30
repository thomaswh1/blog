<!-- <div id="sign" class="sign">
    <div class="part loginPart">
        <form id="login" action="{{url('/login')}}" method="post" novalidate="novalidate">
            <h3>登录<p class="status"></p></h3>
            <p> <label class="icon" for="username"><i class="fa fa-user"></i></label> <input class="input-control" id="username" type="text" placeholder="请输入用户名" name="username" required="" aria-required="true" /> </p>
            <p> <label class="icon" for="password"><i class="fa fa-lock"></i></label> <input class="input-control" id="password" type="password" placeholder="请输入密码" name="password" required="" aria-required="true" /> </p>
            <p class="safe"> <label class="remembermetext" for="rememberme"><input name="rememberme" type="checkbox" checked="checked" id="rememberme" class="rememberme" value="forever" />记住我的登录</label> <a class="lost" href="">忘记密码 ?</a> </p>
            <p> <input class="submit" type="submit" value="登录" name="submit" /> </p>
            <a class="close"><i class="fa fa-times"></i></a>
            <input type="hidden" id="security" name="security" value="0a0415938b" />
            <input type="hidden" name="_wp_http_referer" value="/" />
        </form>
    </div>
    <div class="part registerPart">
        <form id="register" action="{{url('/zhuce')}}" method="post" novalidate="novalidate">
            <div id="login-active" class="switch">
                <i class="fa fa-toggle-off"></i>切换登录
            </div>
            <h3>注册<p class="status"></p></h3>
            <p> <label class="icon" for="user_name"><i class="fa fa-user"></i></label> <input class="input-control" id="user_name" type="text" name="user_name" placeholder="输入英文用户名" required="" aria-required="true" /> </p>
            <p> <label class="icon" for="user_email"><i class="fa fa-envelope"></i></label> <input class="input-control" id="user_email" type="email" name="user_email" placeholder="输入常用邮箱" required="" aria-required="true" /> </p>
            <p> <label class="icon" for="user_pass"><i class="fa fa-lock"></i></label> <input class="input-control" id="user_pass" type="password" name="user_pass" placeholder="密码最小长度为6" required="" aria-required="true" /> </p>
            <p> <label class="icon" for="user_pass2"><i class="fa fa-retweet"></i></label> <input class="input-control" type="password" id="user_pass2" name="user_pass2" placeholder="再次输入密码" required="" aria-required="true" /> </p>
            <p> <input class="submit" type="submit" value="注册" name="submit" /> </p>
            <a class="close"><i class="fa fa-times"></i></a>
            <input type="hidden" id="user_security" name="user_security" value="a2adda87ef" />
            <input type="hidden" name="_wp_http_referer" value="/" />
        </form>
    </div>
</div> -->
<!-- <script type="text/javascript">
      var form = document.getElementById('submit');
      form.onclick = function(data){
              var username = $("input[name='username']").val();
              var password = $("input[name='password']").val();
            //发异步，把数据提交给php
              $.ajax({
                      type:'GET',
                      url:'/login',
                      dataType:'json',
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      data:{username:username,password:password},
                      success:function(data){
                          // 弹层提示添加成功，并刷新父页面
                          console.log(data);

                      },
                      error:function(){
                          //返回错误信息
                      },
                  });
            return false;

          }
</script>
 -->

<div class="floatbtn">
    <!-- Comment -->
    <!-- /.Comment -->
    <!-- Share -->
    <span id="bdshare" class="bdshare_t mobile-hide"><a class="bds_more" href="#" data-cmd="more"><i class="fa fa-share-alt"></i></a></span>
    <!-- /.Share -->
    <!-- Simplified or Traditional -->
    <span id="zh-cn-tw" class="mobile-hide"><i><a id="StranLink">繁</a></i></span>
    <!-- /.Simplified or Traditional -->

    <!-- Scroll Top -->
    <span id="back-to-top"><i class="fa fa-arrow-up"></i></span>
    <!-- /.Scroll Top -->
</div>
<!-- /.Footer Nav Wrap -->
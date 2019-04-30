<!DOCTYPE html>
<html lang="zh-CN">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="Cache-Control" content="no-transform" />
 <meta http-equiv="Cache-Control" content="no-siteapp" />
 <meta name="baidu-site-verification" content="fu3PTj4mmu" />
 <!-- 引入页面描述和关键字模板 -->
 <title>{{$art->art_title}}</title>
 <meta name="description" content="{{$art->art_description}}" />
 <meta name="keywords" content="{{$art->art_tag}}" />

@include('home.public.styles')
@include('home.public.script')

 <!-- 引入用户自定义代码 -->
 <script type="text/javascript">
  window._wpemojiSettings = {"baseUrl":"http:\/\/s.w.org\/images\/core\/emoji\/72x72\/","ext":".png","source":{"concatemoji":"http:\/\/www.iydu.net\/wp-includes\/js\/wp-emoji-release.min.js?ver=4.3.6"}};
  !function(a,b,c){function d(a){var c=b.createElement("canvas"),d=c.getContext&&c.getContext("2d");return d&&d.fillText?(d.textBaseline="top",d.font="600 32px Arial","flag"===a?(d.fillText(String.fromCharCode(55356,56812,55356,56807),0,0),c.toDataURL().length>3e3):(d.fillText(String.fromCharCode(55357,56835),0,0),0!==d.getImageData(16,16,1,1).data[0])):!1}function e(a){var c=b.createElement("script");c.src=a,c.type="text/javascript",b.getElementsByTagName("head")[0].appendChild(c)}var f,g;c.supports={simple:d("simple"),flag:d("flag")},c.DOMReady=!1,c.readyCallback=function(){c.DOMReady=!0},c.supports.simple&&c.supports.flag||(g=function(){c.readyCallback()},b.addEventListener?(b.addEventListener("DOMContentLoaded",g,!1),a.addEventListener("load",g,!1)):(a.attachEvent("onload",g),b.attachEvent("onreadystatechange",function(){"complete"===b.readyState&&c.readyCallback()})),f=c.source||{},f.concatemoji?e(f.concatemoji):f.wpemoji&&f.twemoji&&(e(f.twemoji),e(f.wpemoji)))}(window,document,window._wpemojiSettings);
 </script>

</head>
<body id="wrap" class="single single-post postid-5136 single-format-aside">
<!-- Nav -->
<!-- Moblie nav-->
<div id="body-container">

@include('home.public.navmenu')
 <!-- /.Moblie nav -->
 <section id="content-container" style="background:#f1f4f9; ">

{{--header start--}}
  @include('home.public.header')
{{--header end--}}

  <div class="breadcrumbs">
   <div class="container clr">
    <div id="breadcrumbs">
     <h1> <i class="fa fa-pen"></i> {{$art->art_title}}</h1>
     <div class="breadcrumbs-text">
      <a href="{{url('/index')}}" title="{{$cate->cate_name}}">主页</a>&nbsp;&raquo;&nbsp;
      <a href="{{url('/lists/'.$art->cate_id)}}" rel="category tag">{{$cate->cate_name}}</a>&nbsp;&raquo;&nbsp;{{$art->art_title}}</div>
    </div>
   </div>
  </div>
  <!-- Header Banner -->
  <!-- /.Header Banner -->
  <!-- Main Wrap -->
  <div id="main-wrap">
   <div id="sitenews-wrap" class="container"></div>
   <div id="single-blog-wrap" class="container two-col-container">
    <div id="main-wrap-left">
     <!-- Content -->
     <div class="content">
      <!-- Post meta -->
      <div id="single-meta">
       <span class="single-meta-author"><i class="fa fa-user">&nbsp;</i><a href="#" title="由{{$art->art_editor}}发布" rel="author">{{$art->art_editor}}</a></span>
       <span class="single-meta-time"><i class="fa fa-calendar">&nbsp;</i>{{date('Y-m-d',$art->art_time)}}</span>
       <span class="single-meta-category"><i class="fa fa-folder-open">&nbsp;</i><a href="{{url('/lists/'.$art->cate_id)}}" rel="category tag">{{$cate->cate_name}}</a></span>
       <span class="single-meta-views"><i class="fa fa-fire"></i>&nbsp;{{$art->art_view}}&nbsp;</span>
      </div>
      <!-- /.Post meta -->

      <div class="single-thumb">
      </div>
{{--正文--}}
      <div class="single-text" >
       {!!$art->art_content!!}
      </div>
{{--正文--}}

      <!-- Single Activity -->
      <div class="single-activity">
       <div class="mark-like-btn tinlike clr">
      <!-- 喜欢 -->
        <a class="share-btn love" pid="5136" artid="{{$art->art_id}}" href="javascript:;" title="点击喜欢"> <i class="fa fa-heart"></i> <span>{{$art->art_love}}</span>人喜欢 </a>
        <script type="text/javascript">
          $(".love").click(function(){
            var _this = $(this);
            var artid = _this.attr('artid');
            if(_this.hasClass('love-yes')) return;
          $.ajax({
            type: 'POST',
            dataType: 'html',
            url: '/love',
            data: 'action=like' + '&artid=' + artid ,
            cache: false,
            success: function(){
              var num = _this.children("span").text();
              _this.children("span").text(Number(num)+1);
              _this.addClass("love-animate").attr("title","已喜欢");
              setTimeout(function(){_this.removeClass('love-animate').addClass('love-yes');},500);
            }
            });
          });
        </script>
        <!-- 收藏 -->
        <a class="share-btn collects collect-no" style="cursor:default;" uid="" artid="{{$art->art_id}}" title="你必须注册并登录才能收藏"> <i class="fa fa-star"></i> <span>{{$art->art_collect}}人收藏 </span> </a>
        <script type="text/javascript">
          $('.collects').click(function(){
              var _this = $(this);
              //文章id /用户id
              var artid = Number(_this.attr('artid'));
              if(_this.attr('uid')&&_this.hasClass('collect-no')){
                var uid = Number(_this.attr('uid'));
                $.ajax({
                  type: 'POST',
                  dataType: 'html',
                  url: '/collect',
                  data: 'uid=' + uid + '&artid=' + artid + '&act=add',
                  cache: false,
                  success: function(){
                    _this.children("span").text("已收藏");
                    _this.addClass("collect-animate").attr("title","已收藏");
                    setTimeout(function(){
                      _this.removeClass('collect-animate').removeClass('collect-no').addClass('collect-yes');}, 500);
                  }
                });
                return false;
              }else if(_this.attr('uid')&&_this.hasClass('collect-yes')){
                var uid = Number(_this.attr('uid'));
                $.ajax({
                  type: 'POST',
                  dataType: 'html',
                  url:'collect',
                  data: 'uid=' + uid + '&artid=' + artid + '&act=remove',
                  cache: false,
                  success: function(){
                    _this.children("span").text("点击收藏");
                    _this.addClass("collect-animate").attr("title","点击收藏");
                    setTimeout(function(){
                      _this.removeClass('collect-animate').removeClass('remove-collect').removeClass('collect-yes').addClass('collect-no');},500);
                  }
                });
                return false;
              }else{
                return;
              }     
            })
        </script>

       </div>
      </div>
      <!-- /.Single Activity -->

     </div>
     <!-- /.Content -->
     <!-- Comments -->
     <div class="comments-main">
      <div id="respond_box">
       <div style="margin:8px 0 8px 0">
        <h3 class="multi-border-hl"><span>发表评论</span></h3>
       </div>
      </div>

      <div class="comt-box"> 
      <!-- 写评论 -->
    <form action="" method="" id="form">
      <textarea name="content" id="comment" tabindex="5" rows="5" cols="60" placeholder="说点什么吧..." required=""></textarea> 
      <div class="comt-ctrl"> 
        <input type="hidden" name="post_id" value="{{$art->art_id}}"><!-- 文章ID -->
        <input type="hidden" name="nickname" value="1" id="nickname" /> <!-- 评论人 -->
        <input type="hidden" name="parent_id" id="parent_id" value="0" /> <!-- 是否一级评论  -->
        <button class="submit btn btn-submit" type="submit" id="submit" tabindex="6"><i class="fa fa-check-square-o"></i> 提交评论</button>         
      </div>
    </form>
    <script type="text/javascript">
      var form = document.getElementById('submit');
       form.onclick = function(data){
              var post_id = $("input[name='post_id']").val();
              var nickname = $("input[name='nickname']").val();
              var parent_id = $("input[name='parent_id']").val();
              var content = $("textarea[name='content']").val();
            //发异步，把数据提交给php
              $.ajax({
                      type:'GET',
                      url:'/liuyan',
                      dataType:'json',
                      data:{content:content,nickname:nickname,post_id:post_id,parent_id:parent_id},
                      success:function(data){
                          // 弹层提示添加成功，并刷新父页面
                          console.log(data);
                          if(data.status == 0){
                              alert(data.message);
                              document.location.reload();
                            
                          }else {
                              alert(data.message);
                          }
                      },
                      error:function(){
                          //返回错误信息
                      },
                  });
            return false;
          };
    </script>

      <!-- 评论 -->
      <div class="commenttitle">
         <span id="comments" class="active"><i class="fa fa-comments-o"></i>{{count($comment)}} 评论</span>
      </div>

      <ol class="commentlist" id="normal_comments">
         @foreach($comment as $v)
        <li class="comment even thread-even depth-1" id="comment-22371">
          <div id="div-comment-22371" class="comment-body">
            <span> {{$v->nickname}}</span>
           <!-- <span class="floor"> #47 </span> -->
           <div class="comment-main">
            <p>
              {{$v->content}}
            </p>
            <div class="comment-author">
             <div class="comment-info">
              <span class="comment_author_vip tooltip-trigger" title="评论达人 LV.1"><span class="vip vip1">评论达人 LV.1</span></span><span class="comment_author_link">{{$v->nickname}}</span>
              <span class="datetime"> {{date('Y-m-d',$v->create_time)}}</span>
             </div>
            </div>
            <div class="clear"></div>
           </div>
          </div>
          <!-- .children --> 
        </li>
         @endforeach 
      </ol>

    </div>

     </div>
     <!-- /.Comments -->
    </div>
    <!-- Sidebar -->
    <script type="text/javascript">
     $('.site_loading').animate({'width':'55%'},50);  //第二个节点
    </script>

   {{--右侧边栏 start--}}
   @include('home.public.aside')
   {{--右侧边栏 end--}}
    <!-- /.Sidebar -->
   </div>
  </div>
  <!--/.Main Wrap -->
  <!-- Bottom Banner -->
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
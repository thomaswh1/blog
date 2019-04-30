
@extends('layouts.home_lists')

@section('title',"博客列表-{$cate->cate_name}")

@section("main-wrap")
{{--banner--}}

<!-- Main Wrap -->
    <div id="main-wrap">
     <div id="home-blog-wrap" class="container two-col-container">
      <div id="main-wrap-left">

       @foreach($cate_arts as $k=>$v)
        @foreach($v->article as  $m=>$n)
       <div class="bloglist-container clr">
        <article class="home-blog-entry col span_1 clr">
         <a href="{{url('/detail/'.$n->art_id)}}" title="{{$n->art_title}}" class="fancyimg home-blog-entry-thumb">
          <div class="thumb-img">
           <img src="{{$n->art_thumb}}" alt="{{$n->art_title}}" />
           <span><i class="fa fa-pencil"></i></span>
          </div> </a>
         <div class="home-blog-entry-text clr">
          <h3> <a href="{{url('/detail/'.$n->art_id)}}" title="{{$n->art_title}}">{{$n->art_title}}</a> </h3>
          <!-- Post meta -->
          <div class="meta">
           <span class="postlist-meta-time"><i class="fa fa-calendar"></i>{{date('Y-m-d',$n->art_time)}}</span>
           <span class="postlist-meta-views"><i class="fa fa-fire"></i>{{$n->art_view}}</span>
           {{--<span class="postlist-meta-comments"><i class="fa fa-comments"></i><a href="http://www.iydu.net/5148.html#comments"><span>评论: </span>0</a></span>--}}
          </div>
          <!-- /.Post meta -->

             <p> {{$n->art_title}} <a rel="nofollow" class="more-link" style="text-decoration:none;" href="http://www.iydu.net/5148.html"></a></p>

         </div>
         <div class="clear"></div>
        </article>
       </div>
       @endforeach
      @endforeach

       <!-- pagination  分页-->
        <div class="clear">
        </div>
         <div class="container">
          @foreach ($cate_arts as $user)
           {{ $user->name }}
          @endforeach
         </div>
         {{ $cate_arts->links() }}
      </div>

      <script type="text/javascript">
	    $('.site_loading').animate({'width':'55%'},50);  //第二个节点
      </script>

      {{--右侧边栏 start--}}
      @parent
      {{--右侧边栏 end--}}

     </div>
    </div>
    <!--/.Main Wrap -->

 @endsection
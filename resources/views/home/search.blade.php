<!DOCTYPE html>
<html lang="zh-CN">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <!-- 引入页面描述和关键字模板 --> 
  <title>搜索结果</title>

  @include('home.public.styles')
  @include('home.public.script')

 </head> 
 <body id="wrap" class="search search-results"> 
  <!-- Nav --> 
  <div id="body-container">

   <!-- Moblie nav-->
  @include('home.public.navmenu')
  <!-- /.Moblie nav -->

   <section id="content-container" style="background:#f1f4f9; ">

    {{--header start--}}
    @include('home.public.header')
    {{--header end--}}

    <div class="breadcrumbs"> 
     <div class="container clr"> 
      <div id="breadcrumbs">
       <h1> <i class="fa fa-search"></i> 网站搜索 </h1> 
       <div class="breadcrumbs-text">
        <?php echo count($p).'个搜索结果';?>
      
       </div> 
      </div> 
     </div> 
    </div>

    <!-- Header Banner --> 
    <!-- /.Header Banner --> 
    <!-- Main Wrap --> 
    <div id="main-wrap"> 
     <div id="home-blog-wrap" class="container two-col-container"> 
      <div id="main-wrap-left"> 
       <div class="bloglist-container clr"> 
         @if(!empty($p)) 
          @foreach($p as $v)
        <article class="home-blog-entry col span_1 clr">
         <a href="{{url('/detail/'.$v->art_id)}}" title="{{$v->art_title}}" class="fancyimg home-blog-entry-thumb"> 
          <div class="thumb-img"> 
           <img src="{{$v->art_thumb}}" alt="{{$v->art_title}}" /> 
           <span><i class="fa fa-pencil"></i></span> 
          </div> </a> 
         <div class="home-blog-entry-text clr"> 
          <h3> <a href="{{url('/detail/'.$v->art_id)}}" title="{{$v->art_title}}">{{$v->art_title}}</a> </h3> 
          <!-- Post meta --> 
          <div class="meta"> 
            @foreach($cate as $n)
             @if($v->cate_id ==$n->cate_id) 
            <span class="postlist-meta-cat"><i class="fa fa-bookmark"></i><a href="{{url('/lists/'.$n->cate_id)}}" rel="category tag">{{$n->cate_name}}</a></span> 
             @endif
            @endforeach
           <span class="postlist-meta-time"><i class="fa fa-calendar"></i>{!!date('Y-m-d',$v->art_time)!!}</span> 
           <span class="postlist-meta-views"><i class="fa fa-fire"></i>浏览: {{$v->art_view}}</span> 
          </div> 
          <!-- /.Post meta --> 
          <p> {{$v->art_description}}<a rel="nofollow" class="more-link" style="text-decoration:none;" href="{{url('/detail/'.$v->art_id)}}"></a> </p> 
         </div> 
         <div class="clear"></div>  
        </article>
            @endforeach 
        @endif 
       </div>
       
      </div> 
      <script type="text/javascript">
	$('.site_loading').animate({'width':'55%'},50);  //第二个节点
</script>

         {{--右侧边栏 start--}}
         @include('home.public.aside')
         {{--右侧边栏 end--}}

     </div> 
    </div> 
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
<div id="sidebar" class="clr">

    <div id="tinsitestatistic-3" class="widget widget_tinsitestatistic">
        <ul>
            <li><span style="color: #0C0C0C;font-size: 20px;">目&nbsp;录</span></li>
            <li>&nbsp;</li>
            @foreach($cateone as $k=>$v)
                <li ><a href="{{url('/lists/'.$v->cate_id)}}">&nbsp;&nbsp;{{$v->cate_name}}</a>
                    @if(!empty($catetwo[$k]))
                            @foreach($catetwo[$k] as $m=>$n)
                                <li ><a href="{{url('/lists/'.$n->cate_id)}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$n->cate_name}}</a></li>
                            @endforeach
                    @endif
            @endforeach

        </ul>
        <div class="clear"></div>
    </div>

    <div id="tinbookmark-2" class="widget widget_tinbookmark">
        <h3><span class="widget-title">友情链接</span></h3>
        <div class="tinbookmark">
            <ul>
                @foreach($links as $k=>$v)
                    <li class="tinbookmark-list "><i class="fa fa-angle-right"></i><a href="{{$v->link_url}}" title="{{$v->link_title}}" target="_blank">{{$v->link_name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="floatwidget-container">
    </div>
</div>
<script type="text/javascript">
    $('.site_loading').animate({'width':'78%'},50);  //第三个节点
</script>
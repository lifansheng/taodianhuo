@extends("layout.person")
@section("title", $title)
@section("content")
		<link href="/homes/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/homes/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/homes/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/homes/css/footstyle.css" rel="stylesheet" type="text/css">


		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-foot">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的足迹</strong> / <small>Browser&nbsp;History</small></div>
							<button id="qing" style="float:right;background:white;border-radius:5px;border:solid 1px white;">清空足迹</button>
						</div>
						<hr/>

						<!--足迹列表 -->
				@foreach($foots as $v)
				@foreach($goodss as $vv)
				@if(session('hid') == $v->hid && $v->goods_id == $vv->id)

				<div class="goods" value="{{session('hid')}}">
					<div class="goods-date" data-date="{{$v->created_at}}">
						<span>浏览于{{$v->created_at}}</span>
						<s class="line"></s>
					</div>

					<div class="goods-box first-box">
						<div class="goods-pic">
							<div class="goods-pic-box">
								<a class="goods-pic-link" target="_blank" href="/home/details?id={{$vv->id}}" title="{{$vv->gname}}">
									<img src="{{$vv->imgs}}" class="goods-img" width="188px" height="188px"></a>
							</div>
							<a id="{{$v->id}}" class="goods-delete" href="javascript:void(0)">
								<!-- href="/home/delfoots?id={{$v->id}}" -->
								<i class="am-icon-trash"></i>
							</a>
							<!-- <div class="goods-status goods-status-show"><span class="desc">宝贝已下架</span></div> -->
						</div>

						<div class="goods-attr">
							<div class="good-title">
								<a class="title" href="/home/details?id={{$vv->id}}" target="_blank">{{$vv->gname}}</a>
							</div>
							<div class="goods-price">
								<span class="g_price">                                    
                                <span>¥</span><strong>{{$vv->price}}</strong>
								</span>
								<!-- <span class="g_price g_price-original">                                    
                                <span>¥</span><strong>142</strong>
								</span> -->
							</div>
							<div class="clear"></div>
							<div class="goods-num">
								<div class="match-recom" >
									<a href="/home/details?id={{$vv->id}}" class="match-recom-item">查看详情</a>
									<i><em></em><span></span></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endif
				@endforeach
				@endforeach
				<!-- <div class="emptys">
					<div>
						
					</div>
				</div> -->
				<div class="cart-empty" style="display:none;position:absolute;margin-top:120px;margin-left:200px;">
				    <div class="message">
				        <ul>
				            <li class="txt"	style="font-size:25px;font-family:华文彩云;">
				                足迹空空的哦~，去看看心仪的商品吧~
				            </li>
				            <li class="mt10" style="margin-top:15px;">
				                <a href="/" class="ftx-05" style="font-size:25px;font-family:华文彩云;">
				                    去购物-->
				                </a>
				            </li>
				            
				        </ul>
				   	</div>
				</div>
	</div>
</div>
<script src="/admins/js/libs/jquery-3.3.1.min.js"></script>
<script>
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	// 点击足迹删除事件
   $(".goods-delete").click(function(){
   		var t = $(this);
   		// 确认是否删除
   		var rs = confirm("删除该足迹?");
		if(!rs) return;

		// 确认删除 获取当前足迹的id
		var ids = $(this).attr("id");

		// 将此id通过ajax发送 
		$.post("/home/ajaxcheckfoots", {ids:ids}, function(data){
			// console.log(data);
			if (data == 1) {
				// 删除当前足迹
				t.parents().remove(".goods");
				foots();
			}
		})	
   })

   // 点击清空足迹按钮事件
   $("#qing").click(function(){
   		// 确认是否清空足迹
   		var rs = confirm("清空足迹?");
		if(!rs) return;

		// 获取当前的用户id 
		var ids = $('.goods').attr("value");	// console.log(ids);

		// 将此id发送ajax
		$.post("/home/ajaxcheckfootss", {ids:ids}, function(data){
			// console.log(data);
			if (data == 1) {
				// 删除当前足迹
				$('.goods').remove(".goods");
				foots();
			}
		})	
   })

   // 当足迹清空时
   function foots()
   {
   		// 获取当前足迹的数量
   		var num = $(".goods").length;

   		// 当足迹为0时
   		if(num == 0){
   			$('.cart-empty').show();
   			$(".goods").hide;
   		}

   }
   foots()
</script>

@stop
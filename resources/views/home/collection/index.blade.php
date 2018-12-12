@extends('layout.person')

@section('title',$title)

@section('content')

		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-collection">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的收藏</strong> / <small>My&nbsp;Collection</small></div>
						</div>
						<hr/>

						<div class="you-like">
							<div class="s-bar">
								我的收藏
								<a class="am-badge am-badge-danger am-round">降价</a>
								<a class="am-badge am-badge-danger am-round">下架</a>
							</div>
							<div class="s-content">
								@foreach($res as $k=>$v)
								<div class="s-item-wrap" id="shanba">
									<div class="s-item">

										<div class="s-pic">
											<a href="javascript:void(0);" class="s-pic-link">
												<img src="{{$v->shopimgs}}" class="s-pic-img s-guess-item-img" width="200px" height="250px">
											</a>
										</div>
										<div class="s-info">
											<div class="s-title"><a href="javascript:void(0);" title="">{{$v->shopname}}</a></div>
											<div class="s-price-box">
												<span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">{{$v->shopprice-2}}</em></span>
												<span class="s-history-price"><em class="s-price-sign">¥</em><em class="s-value">{{$v->shopprice}}</em></span>
											</div>
										</div>
										<div class="s-tp">
											<span class="ui-btn-loading-before qugou" gid="{{$v->gid}}">去购买</span>
											<i class="am-icon-shopping-cart"></i>
											<span class="ui-btn-loading-before buy" id="{{$v->id}}">取消收藏</span>
										</div>
									</div>
								</div>
								@endforeach
							</div>

							<div class="cart-empty" style="display:none;position:absolute;margin-top:120px;margin-left:200px;">
							    <div class="message">
							        <ul>
							            <li class="txt"	style="font-size:25px;font-family:华文彩云;">
							                收藏是空的，快去看看心仪的商品吧~
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

				</div>
@stop

@section('js')
<script type="text/javascript">
	$('.qugou').click(function(){
		var gid = $(this).attr('gid');
		window.location.href='/home/details?id='+gid;
	});
	$('.buy').click(function(){
		var rs = confirm('确定要取消收藏商品?');
		if(!rs) return;
		var id = $(this).attr('id');
		rem = $(this);
		$.get('/home/qushoucang',{id:id},function(data){
			// alert(data);
			if(data == 1){
				rem.parents().remove('#shanba');
				shoucang()
			}
		})
	});

	// 当收藏清空时
   function shoucang()
   {
   		// 获取当前足迹的数量
   		var num = $("#shanba").length;

   		// 当足迹为0时
   		if(num == 0){
   			$('.cart-empty').show();
   			$("#shanba").hide;
   		}

   }
   shoucang()
</script>
@stop

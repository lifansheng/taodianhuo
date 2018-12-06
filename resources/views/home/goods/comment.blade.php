
	@extends('layout.person')

	@section('title',$title)
		
	@section('content')
		<link href="/homes/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/homes/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
		<link href="/homes/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/homes/css/appstyle.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="/homes/js/jquery-1.7.2.min.js"></script>

			@if(session('success'))
					
	                <div class="mws-form-message success">
	                    <cenetr><li style='list-style:none;font-size:20px;text-align: center;'>{{session('success')}}</li></cneter>
	                </div>

            @endif

            @if(session('error'))
                <div class="mws-form-message error">
                    <li style='list-style:none;font-size:20px;text-align: center;color: red;'>{{session('error')}}</li>
                </div>
            @endif
            <script>
   				 $('.mws-form-message').delay(1000).fadeOut(2000);
			</script>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-comment">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">发表评论</strong> / <small>Make&nbsp;Comments</small></div>
						</div>
						<hr/>
						<div class="comment-main">
							  <form class="mws-form" action="/home/comment" method="post" enctype="multipart/form-data">
            						{{csrf_field()}}
								<div class="comment-list">
									<div class="item-pic">
										<a href="JavaScript:void(0)" class="J_MakePoint">
											<img src="{{$data->imgs}}" class="itempic">
										</a>
									</div>

									<div class="item-title">

										<div class="item-info" style="margin-left: 20px;">
											<div class="info-little">

												<p>口味:{{$data->leixing}}</p>
												<p>包装:{{$data->size}}</p>
											</div>
											<div class="item-price">
												价格：<strong>{{$data->price}}元</strong>
											</div>										
										</div>
									</div>
									<div class="clear"></div>
									<div class="item-comment">
										<textarea placeholder="请写下对宝贝的感受吧，对他人帮助很大哦！" name="content"></textarea>
									</div>
									<!-- <div class="filePic">
										<input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*" >
										<span>晒照片(0/5)</span>
										<img src="/homes/images/image.jpg" alt="">
									</div> -->
									<div class="item-opinion">
										<!-- <li name='star' value="2" checked><i class="op1"></i>好评</li>
										<li name='star' value="1"><i class="op2" ></i>中评</li>
										<li name='star' value="0"><i class="op3" ></i>差评</li> -->
										<ul class="mws-form-list inline">
				                            <li><label><input type="radio" class="op1" name='star' value="2" checked>好评</li>
				    						<li><label><input type="radio" name='star' value="1">一般</label></li>
				    						<li><label><input type="radio" name='star' value="0">差评</label></li>
				                        </ul>
				                        <input type="text" name="uid" value="{{$data->hid}}" hidden>
				                        <input type="text" name="gid" value="{{$data->gid}}" hidden>
				                        <input type="text" name="oid" value="{{$data->oid}}" hidden>
				                        <!-- <input type="text" name="uid" value="" hidden> -->
									</div>
								</div>
								<div class="info-btn">
									<button class="am-btn am-btn-danger">发表评论</button>
								</div>	
							</form>
							
							<!--多个商品评论-->
		<!-- 					<div class="comment-list">
								<div class="item-pic">
									<a href="#" class="J_MakePoint">
										<img src="/homes/images/comment.jpg_400x400.jpg" class="itempic">
									</a>
								</div>

								<div class="item-title">

									<div class="item-name">
										<a href="#">
											<p class="item-basic-info">美康粉黛醉美唇膏 持久保湿滋润防水不掉色</p>
										</a>
									</div>
									<div class="item-info" style="margin-left: 20px;">
										<div class="info-little">
											<span>颜色：洛阳牡丹</span>
											<span>包装：裸装</span>
										</div>
										<div class="item-price">
											价格：<strong>19.88元</strong>
										</div>
									</div>
								</div>
								<div class="clear"></div>
								<div class="item-comment">
									<textarea placeholder="请写下对宝贝的感受吧，对他人帮助很大哦！"></textarea>
								</div>
								<div class="filePic">
									<input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="/homes/image/*" >
									<span>晒照片(0/5)</span>
									<img src="/homes/images/image.jpg" alt="">
								</div>
								<div class="item-opinion">
									<li><i class="op1"></i>好评</li>
									<li><i class="op2"></i>中评</li>
									<li><i class="op3"></i>差评</li>
								</div>
							</div>
						 -->
														
					<script type="text/javascript">
						$(document).ready(function() {
							$(".comment-list .item-opinion li").click(function() {	
								$(this).prevAll().children('i').removeClass("active");
								$(this).nextAll().children('i').removeClass("active");
								$(this).children('i').addClass("active");
								
							});
				     })
					</script>					
					
												
							
						</div>

					</div>

				</div>
				<!--底部-->
@stop
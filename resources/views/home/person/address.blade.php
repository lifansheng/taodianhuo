@extends('layout.person')
@section('title','地址管理')
@section('content')

<link href="/homes/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/homes/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/homes/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/homes/css/addstyle.css" rel="stylesheet" type="text/css">
		<script src="/homes/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="/homes/AmazeUI-2.4.2/assets/js/amazeui.js"></script>

		<!-- <link href="/homes/address/css/main.css" rel="stylesheet" type="text/css" /> -->
<link href="http://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/homes/address/css/city-picker.css" rel="stylesheet" type="text/css" />
<script src="/homes/address/js/jquery.js"></script>
<script src="/homes/address/js/bootstrap.js"></script>
<script src="/homes/address/js/city-picker.data.js"></script>
<script src="/homes/address/js/city-picker.js"></script>
<script src="/homes/address/js/main.js"></script>

		<b class="line"></b>

		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-address">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
						</div>
						<hr/>
						<ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">

							
@foreach($data as $v)
							@if(session('hid') == $v->hid)
							
							

								<!-- 设置为默认样式 -->
								@if($v -> status == 1) 
								
								<li class="user-addresslist defaultAddr">
									<input type="hidden"  id="{{$v -> id}}" hid="{{$v -> hid}}">
									<!-- <input type="hidden"  id="{{$v -> status}}"> -->
								<span class="new-option-r" id="mr1"><i class="am-icon-check-circle"></i>默认地址</span>
								
								
								<p class="new-tit new-p-re">
									<span class="new-txt">{{$v -> name}}</span>
									<span class="new-txt-rd2">{{$v -> phone}}</span>
								</p>
								<div class="new-mu_l2a new-p-re">
									<p class="new-mu_l2cw">
										<span class="title">地址：</span>
										
										
										<span class="street">{{$v -> address}}&nbsp;&nbsp;{{$v -> xiangxiaddress}}</span></p>
										
								</div>
								<form action="/home/address/{{$v->id}}" method="post">
{{csrf_field()}}
{{method_field('DELETE')}}
								
									<div class="new-addr-btn">
										<a href="/home/address/{{$v -> id}}/edit"><i class="am-icon-edit"></i>编辑</a>
									<span class="new-addr-bar">|</span>
									<button style="border:0px;background-color:transparent;font-color:black"><i class="am-icon-trash"></i>删除</button>
								</div>
							</form>
							</li>
	
								@else 
						<li class="user-addresslist">
							<input type="hidden"  id="{{$v -> id}}" hid="{{$v -> hid}}">
							<!-- <input type="hidden"  id="{{$v -> status}}"> -->
								<span class="new-option-r" id="mr2"><i class="am-icon-check-circle"></i>设为默认</span>
								<p class="new-tit new-p-re">
									<span class="new-txt">{{$v -> name}}</span>
									<span class="new-txt-rd2">{{$v -> phone}}</span>
								</p>
								<div class="new-mu_l2a new-p-re">
									<p class="new-mu_l2cw">
										<span class="title">地址：</span>
										<span class="street">{{$v -> address}}&nbsp;&nbsp;{{$v -> xiangxiaddress}}</span></p>
								</div>

								<form action="/home/address/{{$v->id}}" method="post">
{{csrf_field()}}
{{method_field('DELETE')}}
								
									<div class="new-addr-btn">
										<a href="/home/address/{{$v -> id}}/edit"><i class="am-icon-edit"></i>编辑</a>
									<span class="new-addr-bar">|</span>
									<button style="border:0px;background-color:transparent;font-color:black"><i class="am-icon-trash"></i>删除</button>
								</div>
							</form>
							</li>
							
								


	@endif




			
@endif
@endforeach				
							
						</ul>
						<div class="clear"></div>
						<a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
						<!--例子-->
						<div class="am-modal am-modal-no-btn" id="doc-modal-1">

							<div class="add-dress">

								<!--标题 -->

								<div class="am-cf am-padding">
									<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add&nbsp;address</small></div>
								</div>
								<hr/>





									<div class="container">
										<div class="am-form-group">
											
											<label for="user-phone" class="am-form-label">收货地址</label>
											<div class="am-form-content">
													<div class="docs-methods">
		<form action="/home/address" class="form-inline" method="post" >
			<div id="distpicker">
				
					
					<div style="position: relative;">
						
						<div class="am-form-group">
							<input id="city-picker3" class="form-control"  type="text" value="" data-toggle="city-picker" name="address">
											
											
											</div>

					{{csrf_field()}}

				</div>
				
			</div>

			<div class="am-form-content" style="margin-left: 2px">
												<textarea class="" rows="3" cols="60" id="user-intro" placeholder="输入详细地址" name="xiangxiaddress"></textarea>
													<button class="btn btn-warning" id="reset" type="button" style="margin-top: 27px">重置</button>
					<button class="btn btn-danger" id="destroy" type="button" style="margin-top: 27px">确定</button>
				</div>
		
	</div>
											</div>
	</div>	
								

								<div class="am-u-md-12 am-u-lg-8" style="margin-top: 0px;">
									

										<div class="am-form-group">
											<label for="user-name" class="am-form-label">收货人</label>
											<div class="am-form-content">
												<input type="text" id="user-name" placeholder="收货人" name="name">
											</div>
										</div>

										<div class="am-form-group">
											<label for="user-phone" class="am-form-label" >手机号码</label>
											<div class="am-form-content">
												<input id="user-phone" placeholder="手机号必填" name="phone">
											</div>
										</div>
																	</div>
						
										
										<div class="am-form-group">
											<div class="am-u-sm-9 am-u-sm-push-3">
												<button><a class="am-btn am-btn-danger">保存</a></button>
												<a href="javascript: void(0)" class="am-close am-btn am-btn-danger" data-am-modal-close>取消</a>
											</div>
										</div>
									</form>
								</div>

							</div>

						</div>

					</div>

					<script type="text/javascript">


						
						$(document).ready(function() {							
							$(".new-option-r").click(function() {
								$(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
								// alert('收获地址已经改变')
									


										
							});
							
							var $ww = $(window).width();
							if($ww>640) {
								$("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
							}
							
						})

						$(".new-option-r").click(function() {

							ids = parseInt($(this).prev('input').attr('id'));
							hid = parseInt($(this).prev('input').attr('hid'));

							// status = parseInt($(this).prev('input').prev('input').attr('id'));
							// console.log(hid);
							// console.log(ids);

							$.post('/home/addressajax',{'ids':ids,'hid':hid},function(data){

								console.log(data)
							})
						})


					$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
					</script>
<script> </script>
					<div class="clear"></div>

				</div>
			@stop
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
								
								
								<hr/>





									<div class="container" >
										<div class="am-form-group">
											
											<label for="user-phone" class="am-form-label">收货地址</label>
											<div class="am-form-content"style="margin-left: 100px">
													<div class="docs-methods">
		<form action="/home/address/{{$res -> id}}" class="form-inline" method="post" >
			<div id="distpicker">
				
					
					<div style="position: relative;">
						
						<div class="am-form-group">
							<input id="city-picker3" class="form-control"  type="text" value="{{$res -> address}}" data-toggle="city-picker" name="address">
							{{csrf_field()}}
							{{method_field('PUT')}}				
											
											</div>


				</div>
				
			</div>

			<div class="am-form-content" style="margin-left: 2px">
												<textarea class="" rows="3" cols="60" id="user-intro" placeholder="输入详细地址" name="xiangxiaddress" >{{$res -> xiangxiaddress}}</textarea>
													<button class="btn btn-warning" id="reset" type="button" style="margin-top: 27px">重置</button>
					<button class="btn btn-danger" id="destroy" type="button" style="margin-top: 27px">确定</button>
				</div>
		
	</div>

								<div class="am-u-md-12 am-u-lg-8" style="margin-top: 0px;">
									

										<div class="am-form-group" style="margin-left: -103px;margin-top: 15px" >
											<label for="user-name" class="am-form-label">收货人</label>
											<div class="am-form-content">
												<input type="text" id="user-name" placeholder="收货人" name="name" value="{{$res->name}}">
											</div>
										</div>

										<div class="am-form-group" style="margin-left: -103px">
											<label for="user-phone" class="am-form-label" >手机号码</label>
											<div class="am-form-content">
												<input id="user-phone" placeholder="手机号必填" name="phone" value="{{$res->phone}}">
											</div>
										</div>
																	</div>
						
										
										<div class="am-form-group">
											<div class="am-u-sm-9 am-u-sm-push-3">
												<button><a class="am-btn am-btn-danger">保存</a></button>
												
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
							});
							
							var $ww = $(window).width();
							if($ww>640) {
								$("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
							}
							
						})
					</script>

					<div class="clear"></div>

				</div>
			@stop
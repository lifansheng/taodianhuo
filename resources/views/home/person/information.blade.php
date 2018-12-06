



@extends('layout.person')
@section('title','个人信息')
@section('content')
		<link href="/homes/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/homes/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/homes/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/homes/css/infstyle.css" rel="stylesheet" type="text/css">
		<script src="/homes/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="/homes/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>
		<!-- <script src="/homes/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script> -->
		 <script type="text/javascript" src="/homes/js/jquery.min.js"></script>
		 <script type="text/javascript" src="/homes/js/jquery.qrcode.min.js"></script>


<link rel="stylesheet" href="/homes/css/jHsDate.css" />

<script type="text/javascript" src="/homes/js/jquery.min.js"></script>
<script type="text/javascript" src="/homes/js/jHsDate.js"></script>
			
	
			<b class="line"></b>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-info">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
						</div>
						<hr/>
<!--个人信息 -->
						<div class="info-main">
							<form class="am-form am-form-horizontal" method = "post" action="/home/person/{{session('hid')}}" enctype="multipart/form-data">
						<!--头像 -->
						<div class="user-infoPic">

							<div class="filePic">
								<input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*" name="pic" value="{{$data -> pic}}">
								<img class="am-circle am-img-thumbnail" src="{{$data -> pic}}" alt="" />
							</div>

							<p class="am-form-help">头像</p>

							<div class="info-m">
								<div><b>用户名：<i>{{$data -> username}}</i></b></div>
								<div class="u-level">
									<span class="rank r2">
							             <s class="vip1"></s><a class="classes" href="#">铜牌会员</a>
						            </span>
								</div>
								<div class="u-safety">
									<a href="safety.html">
									 账户安全
									<span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">60分</i></span>
									</a>
								</div>
							</div>
						</div>

						

								<div class="am-form-group">
									<label for="user-name2" class="am-form-label">昵称</label>
									<div class="am-form-content">
										<input type="text" id="user-name2" placeholder="{{$data -> name}}" value="{{$data -> name}}" name="name">

									</div>
								</div>

								<div class="am-form-group">
									<label for="user-name" class="am-form-label">姓名</label>
									<div class="am-form-content">
										<input type="text" id="user-name2" placeholder="{{$data ->username}}" name="username" value="{{$data ->username}}">

									</div>
								</div>

								<div class="am-form-group">
									<label class="am-form-label">性别</label>
									<div class="am-form-content sex">

										<label class="am-radio-inline">
											<input type="radio" name="sex" value="1" data-am-ucheck       @if($data -> sex==1) checked @endif> 男
										</label>
										
										
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="2" data-am-ucheck @if($data -> sex==2) checked @endif> 女
										</label>
										
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="0" data-am-ucheck @if($data -> sex==0) checked @endif> 保密
										</label>
									
									</div>
								</div>

								<div class="am-form-group">
		<label for="user-phone" class="am-form-label">生日</label>							
			<div class="am-form-content">
	<input type="text" id="date2" data-options="{'type':'YYYY-MM-DD','beginYear':1918,'endYear':2018}" value="{{$data -> bir}}" name="bir">
			</div>
</div>





<script src="/homes/js/jquery.min.js"></script>
	<script src="/homes/js/jquery.date.js"></script>
	<script>
	
		$.date('#date2');
		
	</script>



	

 
								<div class="am-form-group">
									<label for="user-phone" class="am-form-label">电话</label>
									<div class="am-form-content">
										<input name = "phone_number" id="user-phone" placeholder="telephonenumber" type="tel"value={{$data -> phone_number}}>

									</div>
								</div>
								<div class="am-form-group">
									<label for="user-email" class="am-form-label">电子邮件</label>
									<div class="am-form-content">
										<input id="user-email" placeholder="Email" type="email" value="{{$data -> email}}" name="email">

									</div>
								</div>
								<div class="am-form-group address">
									<label for="user-address" class="am-form-label">收货地址</label>
									<div class="am-form-content address">
										<a href="address.html">
											<p class="new-mu_l2cw">
												<span class="province">湖北</span>省
												<span class="city">武汉</span>市
												<span class="dist">洪山</span>区
												<span class="street">雄楚大道666号(中南财经政法大学)</span>
												<span class="am-icon-angle-right"></span>
											</p>
										</a>

									</div>
								</div>
								<div class="am-form-group safety">
									<label for="user-safety" class="am-form-label">账号安全</label>
									<div class="am-form-content safety">
										<a href="safety.html">

											<span class="am-icon-angle-right"></span>

										</a>

{{csrf_field()}}
{{method_field('PUT')}}
									</div>
								</div>
								<div class="info-btn">
									<button><div class="am-btn am-btn-danger">保存修改</div></button>
								</div>

							</form>
						</div>

					</div>

				</div>
				<!--底部-->
				@stop
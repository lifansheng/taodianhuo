<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>{{$title}}</title>
<link rel="stylesheet" type="text/css" href="/admins/login/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="/admins/login/css/demo.css" />
<!--必要样式-->
<link rel="stylesheet" type="text/css" href="/admins/login/css/component.css" />
<!--[if IE]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body>
		<div class="container demo-1">
			<div class="content">
				<div id="large-header" class="large-header">
					<canvas id="demo-canvas"></canvas>
					
					<div class="logo_box">
					@if(session('error'))
		            <div class="mws-form-message">
		                <li style="list-style: none;">{{session('error')}}</li>
		            </div>
		       		@endif
						<h3>欢迎登录</h3>
						<form action="/admin/dologin" name="f" method="post">
							<div class="input_outer">
								<span class="u_user"></span>
								<input name="username" class="text" style="color: #FFFFFF !important" type="text" placeholder="请输入账户">
							</div>
							<div class="input_outer">
								<span class="us_uer"></span>
								<input name="password" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;"value="" type="password" placeholder="请输入密码">
							</div>
							<div class="input_outer" style="width:190px;">
								<input name="code" class="text" style="color: #FFFFFF !important" type="text" placeholder="请输入验证码">
							</div>
							<img src="/admin/captcha" alt="" style="position:absolute;margin-left:195px;display:inline;border-radius:10px;margin-top:-73px;" onclick='this.src = this.src+="?1"'>
							
								<input type="submit" value="登录" class="act-but submit" style="width:180px; margin-left:75px;">
                        	{{csrf_field()}}
						</form>
					</div>
				</div>
			</div>
		</div><!-- /container -->
    	<script src="/admins/js/libs/jquery-3.3.1.min.js"></script>
		<script src="/admins/login/js/TweenLite.min.js"></script>
		<script src="/admins/login/js/EasePack.min.js"></script>
		<script src="/admins/login/js/rAF.js"></script>
		<script src="/admins/login/js/demo-1.js"></script>
		<script>
        	$('.mws-form-message').delay(2000).fadeOut(2000);
    	</script>
	</body>
</html>
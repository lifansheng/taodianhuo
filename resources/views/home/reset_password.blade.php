<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>{{$title}}</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="/homes/login/css/style.css" />
<style>
	#but{
	    cursor: pointer;
	    width: 130px;
	    height: 44px;
	    margin-top: 25px;
	    padding: 0;
	    background: rgba(6, 127, 228, 0.71);
	    -moz-border-radius: 6px;
	    -webkit-border-radius: 6px;
	    border-radius: 6px;
	    border: 0;
	    -moz-box-shadow: 0 15px 30px 0 rgba(255,255,255,.25) inset,0 2px 7px 0 rgba(0,0,0,.2);
	    font-family: "Microsoft YaHei",Helvetica,Arial,sans-serif;
	    font-size: 14px;
	    font-weight: 700;
	    color: #fff;
	    text-shadow: 0 1px 2px rgba(0,0,0,.1);
	    -o-transition: all .2s;
	    -moz-transition: all .2s;
	    -webkit-transition: all .2s;
	}
</style>

<body>

<div class="login-container">
	<h1>淘点货商城</h1>
	
	<div class="connect">
		<p>Link the world. Share to world.</p>
	</div>
	<br>
	<form action="/home/do_rp" method="post" id="registerForm">
		{{csrf_field()}}
		<div>
			<input type="password" name="password" class="password" placeholder="输入密码" oncontextmenu="return false" onpaste="return false" />
		</div>
		<div>
			<input type="password" name="confirm_password" class="confirm_password" placeholder="再次输入密码" oncontextmenu="return false" onpaste="return false" />
		</div>
		<input type="hidden" name="phone_number" value="{{$res['phone_number']}}">
		<button id="submit" type="submit">提&nbsp;&nbsp;交</button>
		<!-- <div>
			<input type="submit"  id="submit" value="登 录"/>
		</div> -->
	</form>
</div>
<script src="/homes/login/js/jquery.min.js"></script>
<script src="/homes/login/js/common.js"></script>
<!--背景图片自动更换-->
<script src="/homes/login/js/supersized.3.2.7.min.js"></script>
<script src="/homes/login/js/supersized-init.js"></script>
<!--表单验证-->
<script src="/homes/login/js/jquery.validate.min.js?var1.14.0"></script>
</body>
</html>
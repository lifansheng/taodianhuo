<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{$title}}</title>
<link rel="stylesheet" href="/homes/login/css/style.css" />
<style>
	#submit{
	    cursor: pointer;
	    width: 300px;
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

<div class="register-container">
	<h1>淘点货商城注册</h1>
	
	<div class="connect">
		<p>Link the world. Share to world.</p>
	</div>
	
	<form action="/home/signup" method="post" id="registerForm">
		{{csrf_field()}}
		<div>
			<input type="text" name="username" class="username" placeholder="您的用户名" autocomplete="off"/>
			<label id="username" class="errors" for="username">用户名已被注册</label>
		</div>
		<div>
			<input type="password" name="password" class="password" placeholder="输入密码" oncontextmenu="return false" onpaste="return false" />
		</div>
		<div>
			<input type="password" name="confirm_password" class="confirm_password" placeholder="再次输入密码" oncontextmenu="return false" onpaste="return false" />
		</div>
		<div>
			<input type="text" name="phone_number" class="phone_number" placeholder="输入手机号码" autocomplete="off" id="number"/>
			<label id="phone" class="errors" for="phone">手机号码已被注册</label>
		</div>
		<div>
			<input type="email" name="email" class="email" placeholder="输入邮箱地址" oncontextmenu="return false" onpaste="return false" />
			<label id="email" class="errors" for="email">邮箱已被注册</label>
		</div>
		<div>
			<input type="text" name="code" class="code" placeholder="输入验证码" oncontextmenu="return false" onpaste="return false" />
			<label id="codeerror" class="errors" for="code">验证码错误</label>
			<label id="codeerror" class="errorss" for="code">验证码不能为空</label>
		</div>
		<div>
			<img src="/home/captcha" alt="" onclick='this.src = this.src+="?1"' style="float:right; margin-top:26px; border-radius:8px;">
		</div>

		<!-- <button id="submit" type="submit">注 册</button> -->
		<div>
			<input type="submit"  id="submit"/>
		</div>
	</form>
	<a href="/home/login">
		<button type="button" class="register-tis">已经有账号？</button>
	</a>

</div>


<script src="/homes/login/js/jquery.min.js"></script>
<script src="/homes/login/js/common.js"></script>
<!--背景图片自动更换-->
<script src="/homes/login/js/supersized.3.2.7.min.js"></script>
<script src="/homes/login/js/supersized-init.js"></script>
<!--表单验证-->
<script src="/homes/login/js/jquery.validate.min.js?var1.14.0"></script>
<script>
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	var US = true;
	var PS = true;
	var ES = true;
	var CS = true;

	//  设置提示信息隐藏
    $(".errors").css("display", "none");
    $(".errorss").css("display", "none");


	function regerror()
	{
	    // 用户名
		// 失去焦点事件
		$("input[name=username]").blur(function(){
			// 设置变量t表示当前被选中的对象
		    var t = $(this);
		    
		    // 获取用户输入的值
		    var pv = $(this).val().trim();    // console.log(pv);
		    
		    // 发送ajax与数据库做比对
		    $.post("/home/ajaxhname", {hname:pv}, function(data){
		    	// console.log(data);
		    	if (data == 0) {
		    		$(".errors:eq(0)").removeAttr("style").delay(1500).fadeOut(1500);
		    		US = false;
		    	} else if (data == 1) {
		    		$(".errors:eq(0)").css("display", "none");
		    		US = true;
		    	}
		    })
		})

		// 手机号码
		// 失去焦点事件
		$("input[name=phone_number]").blur(function(){
			// 设置变量t表示当前被选中的对象
		    var t = $(this);
		    
		    // 获取用户输入的值
		    var pv = $(this).val().trim();    // console.log(pv);
		    
		    // 发送ajax与数据库做比对
		    $.post("/home/ajaxphone", {phone:pv}, function(data){
		    	// console.log(data);
		    	if (data == 0) {
		    		$(".errors:eq(1)").removeAttr("style").delay(1500).fadeOut(1500);
		    		PS = false;
		    	} else if (data == 1) {
		    		$(".errors:eq(1)").css("display", "none");
		    		PS = true;
		    	}
		    })
		})

		// 邮箱
		// 失去焦点事件
		$("input[name=email]").blur(function(){
			// 设置变量t表示当前被选中的对象
		    var t = $(this);
		    
		    // 获取用户输入的值
		    var pv = $(this).val().trim();    // console.log(pv);
		    
		    // 发送ajax与数据库做比对
		    $.post("/home/ajaxemails", {emails:pv}, function(data){
		    	// console.log(data);
		    	if (data == 0) {
		    		$(".errors:eq(2)").removeAttr("style").delay(1500).fadeOut(1500);
		    		ES = false;
		    	} else {
		    		$(".errors:eq(2)").css("display", "none");
		    		ES = true;
		    	}
		    })
		})

		// 验证码
		// 失去焦点事件
		$("input[name=code]").blur(function(){
			// 设置变量t表示当前被选中的对象
		    var t = $(this);
		    
		    // 获取用户输入的值
		    var pv = $(this).val().trim();    // console.log(pv);

		    // 验证码不能为空
		    if (pv == "") {
		     	$(".errorss").removeAttr("style").delay(1500).fadeOut(1500);
		     	CS = false; 
		     	return;
		    }
		    
		    // 发送ajax与数据库做比对
		    $.post("/home/ajaxcode", {code:pv}, function(data){
		    	// console.log(data);
		    	if (data == 0) {
		    		$(".errors:eq(3)").removeAttr("style").delay(1500).fadeOut(1500);
		    		CS = false;
		    	} else if (data == 1) {
		    		$(".errors:eq(3)").css("display", "none");
		    		CS = true;
		    	}
		    })
		})
	}
	regerror();

	// 按钮点击事件
	$("#submit").click(function(){

		$('input[name=code]').trigger('blur');
		$('input[name=phone_number]').trigger('blur');
		$('input[name=email]').trigger('blur');
		$('input[name=username]').trigger('blur');

		if (US && PS && ES && CS) {
			return true;
		} else {
			regerror();
			return false;
		}
	})
	
</script>
</body>
</html>
<!--
本代码由js代码收集并编辑整理;
尊重他人劳动成果;
转载请保留js代码链接 - www.jsdaima.com
-->
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

<div class="login-container">
	<h1>淘点货商城</h1>
	
	<div class="connect">
		<p>Link the world. Share to world.</p>
	</div>
	<br>
	@if(session('success'))
        <div class="mws-form-message">
            <li style="list-style: none;display: block; -webkit-transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; border-radius: 0px 0px 5px 5px; width: 300px; height: 34px; border: 1px solid rgba(255,255,255,.15); line-height: 31px; box-shadow: 0 2px 3px 0 rgba(0,0,0,.1) inset; text-shadow: 0 1px 2px rgba(0,0,0,.1); background: green; -moz-border-radius: 6px; margin: 0 auto; border-radius:15px;">{{session('success')}}</li>
        </div>
    @endif
	@if(session('error'))
    <div class="mws-form-message">
        <li style="list-style: none;display: block; -webkit-transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; border-radius: 0px 0px 5px 5px; width: 300px; height: 34px; border: 1px solid rgba(255,255,255,.15); line-height: 31px; box-shadow: 0 2px 3px 0 rgba(0,0,0,.1) inset; text-shadow: 0 1px 2px rgba(0,0,0,.1); background: rgba(245, 26, 26, 0.81); -moz-border-radius: 6px; margin: 0 auto; border-radius:15px;">{{session('error')}}</li>
    </div>
	@endif
	<!-- <label id="codeerror" class="errorsss" for="code">用户名或密码错误</label> -->
	<label id="codeerror" class="errorssss" for="code">您尚未注册，请前往注册页面</label>
	<form action="/home/dologin" method="post" id="loginForm">
		{{csrf_field()}}
		
		<div>
			<input type="text" name="username" class="username" placeholder="用户名/邮箱/密码" autocomplete="off"/>
			<label id="codeerror" class="errorsss" for="code">账号不能为空</label>
		</div>
		<div>
			<input type="password" name="password" class="password" placeholder="密码" oncontextmenu="return false" onpaste="return false" />
			<label id="codeerror" class="errorsssss" for="code">密码不能为空</label>
		</div>
		<div>
			<input type="text" name="code" class="code" placeholder="输入验证码" oncontextmenu="return false" onpaste="return false" />
			<label id="codeerror" class="errorss" for="code">验证码不能为空</label>
			<label id="codeerror" class="errors" for="code">验证码错误</label>
			
		</div>
		<a href="/home/forget_password" style="float:right;font-size:8px;color:#eee;text-decoration:none;margin-top:5px;">忘记密码?</a>
		<div>
			<img src="/home/captcha" alt="" onclick='this.src = this.src+="?1"' style="float:right; margin-top:20px;margin-left:120px; border-radius:8px;">
		</div>
		<button id="submit" type="submit">登 录</button>
		<!-- <div>
			<input type="submit"  id="submit" value="登 录"/>
		</div> -->
	</form>

	<a href="/home/register">
		<button type="button" class="register-tis">还有没有账号？</button>
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
	// 设置ajax为同步
	$.ajaxSetup({async:false});

	var CS = false;
	var US = false;
	var PS = false;

	//  设置提示信息隐藏
    $(".errors").css("display", "none");
    $(".errorss").css("display", "none");
    $(".errorsss").css("display", "none");
    $(".errorssss").css("display", "none");
    $(".errorsssss").css("display", "none");

    
    $('.mws-form-message').delay(2000).fadeOut(2000);

 //    function regerror()
	// {
	    // 验证码
		// 失去焦点事件
		$("input[name=code]").blur(function(){
			// 设置变量t表示当前被选中的对象
		    var t = $(this);
		    
		    // 获取用户输入的值
		    var pv = $(this).val().trim();    // console.log(pv);
		    
		    // 验证码不能为空
	        if (pv == "") {
		     	$(".errorss").removeAttr("style").delay(2000).fadeOut(2000);
		     	CS = false; 
		     	return;
	        }

		    // 发送ajax与数据库做比对
		    $.post("/home/ajaxcode", {code:pv}, function(data){
		    	// console.log(data);
		    	if (data == 0) {
		    		$(".errors").removeAttr("style").delay(2000).fadeOut(2000);
					CS = false;
		    	} else if (data == 1) {
		    		// $(".errors").css("display", "none");
		    		CS = true;
		    	}
		    })
		})

		
	

		// 发送用户名
		$("input[name=username]").blur(function(){
			var uv = $("input[name=username]").val();	// console.log(uv);

			// 发送ajax
			if (uv == ''){
				$(".errorsss").removeAttr("style").delay(2000).fadeOut(2000);
    			US = false;
			 } else {
				$.post("/home/ajaxcontrastname", {username:uv}, function(data){
					// console.log(data);

					if (data == 0) {
						$(".errorssss").removeAttr("style").delay(2000).fadeOut(2000);
						US = false;
					} else if (data == 1) {
						// $(".errorssss").css("display", "none");
				    	US = true;
					}
				})
			}
			
		})

		// 发送密码
		$("input[name=password]").blur(function(data){
			var pv = $("input[name=password]").val();	// console.log(pv);

			if (pv == "") {
				$(".errorsssss").removeAttr("style").delay(2000).fadeOut(2000);
	    		PS = false;
			} else {
				PS = true;
			}
		})
	// }
	// regerror();

	
		/*// 发送ajax
		$.post("/home/ajaxcontrast", {password:pv}, function(data){
			console.log(data);

			if (data == "有这个人但是密码不对") {
				$(".errorsss").removeAttr("style").delay(2000).fadeOut(2000);
				PS = false;
			} else if (data == "都对了") {
				$(".errorsss").css("display", "none");
				PS = true;
			}
		})*/
	

	/*// 验证用户名和密码
	$("#loginForm").submit(function(){
		// 获取用户输入的用户名和密码
		var uv = $("input[name=username]").val();	// console.log(uv);
		var pv = $("input[name=password]").val();	// console.log(pv);

		// 发送ajax 传参username password 
		$.post("/home/ajaxcontrast", {username:uv,password:pv}, function(data){
			// console.log(data);
			// alert(1);
			if (data == 0) {
				$(".errorsss").removeAttr("style").delay(2000).fadeOut(2000);
				XX = false;
			} else if (data == 1) {
				$(".errorsss").css("display", "none");
		    	XX = true;
			}
		})
	})*/

	// 按钮点击事件
	$("#submit").click(function(){

		$("input[name=code]").trigger("blur");
		$("input[name=password]").trigger("blur");
		$("input[name=username]").trigger("blur");
		// console.log(CS)
		// console.log(US)
		// console.log(PS)

			if (CS && US && PS) {
				return true;
			} else {
				// alert(1);
				// regerror();
				return false;
			}			
	})
</script>

</body>
</html>
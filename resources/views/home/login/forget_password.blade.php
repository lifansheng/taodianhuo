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
	
	<div>
		<p style="margin-top:15px;">Link the world. Share to world.</p>
	</div>
	<br>
	@if(session('error'))
    <div class="mws-form-message">
        <li style="list-style: none;display: block; -webkit-transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; border-radius: 0px 0px 5px 5px; width: 300px; height: 34px; border: 1px solid rgba(255,255,255,.15); line-height: 31px; box-shadow: 0 2px 3px 0 rgba(0,0,0,.1) inset; text-shadow: 0 1px 2px rgba(0,0,0,.1); background: rgba(245, 26, 26, 0.81); -moz-border-radius: 6px; margin: 0 auto; border-radius:15px;">{{session('error')}}</li>
    </div>
	@endif
	<form action="/home/do_fp" method="post" id="forms">
		{{csrf_field()}}
		<div>
			<input type="text" name="phone_number" class="phone_number" placeholder="输入手机号码" autocomplete="off" id="number"/>
			<label id="phone" class="errors" for="phone">手机号码格式不正确</label>
			<label id="phone" class="errorss" for="phone">手机号码尚未注册</label>
			<label id="phone" class="errorsss" for="phone">手机号码不能为空</label>
		</div>
		<input type="text" style="width:130px;" name="code" placeholder="请输入验证码">
		<input type="button" value="获取验证码" id="but">
		<label id="phone" class="errorsssss" for="phone">验证码不能为空</label>
		<label id="phone" class="erroras" for="phone">验证码错误</label>
		<button id="submit" type="submit">提&nbsp;&nbsp;交</button>
		<!-- <div>
			<input type="submit"  id="submit" value="登 录"/>
		</div> -->
	</form>

	<a href="/home/register">
		<button type="button" class="register-tis">还有没有账号？</button>
	</a>

</div>

<script src="/homes/login/js/jquery.min.js"></script>
<!-- <script src="/homes/login/js/common.js"></script> -->
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

	//  设置提示信息隐藏
    $(".errors").css("display", "none");
    $(".erroras").css("display", "none");
    $(".errorss").css("display", "none");
    $(".errorsss").css("display", "none");
    $(".errorsssss").css("display", "none");

    $('.mws-form-message').delay(2000).fadeOut(2000);

	var PS = false;
	var CS = false;
	var pv = null;

	// 设置ajax为同步
	$.ajaxSetup({async:false});

	// 手机号码输入框失去焦点事件
	$("input[name=phone_number]").blur(function(){
		// 获得此时用户输入的号码
		pv = $("input[name=phone_number]").val().trim();	// console.log(pv);
		// 如果此时值为空
		if (pv == ''){
			// 提示手机号码不能为空
			$(".errorsss").removeAttr("style").delay(2000).fadeOut(2000);
			PS = false;
			return;
		} 

		// 手机号正则
		var reg = /^(((13[0-9]{1})|(15[0-9]{1})|(16[0-9]{1})|(17[0-9]{1}|(18[0-9]{1})|(19[0-9]{1})))+\d{8})$/;

		// 判断手机号码是否符合正则
		if (!reg.test(pv)) {
			// 如果不符合提示手机号码不符合规则
			$(".errors").removeAttr("style").delay(2000).fadeOut(2000);
			PS = false;
		} else {
			// 发送手机号码(ajax) 看手机号码是否已注册
			$.post("/home/ajaxphone", {phone:pv}, function(data){
				// console.log(data);
				if (data == 0) {
					// 已注册
					PS = true;	
				} else if (data == 1) {
					// 手机号码未注册 
					$(".errorss").removeAttr("style").delay(2000).fadeOut(2000);
					PS = false;
				}
			})	
		}			
	})


	// 发送验证码按钮点击事件
	$("#but").click(function(){
		// 触发手机号码输入框失去焦点事件
	    $("input[name=phone_number]").trigger("blur");

	    // 如果PS为1
	    if (PS == true) {
	    	// 发送ajax 手机号  获取验证码
	        $.post("/home/ajaxpcode", {number: pv},function(data){
	            console.log(data);
	        }) 
	    } else {
	        // 返回
	        return false;        
	    }

	   
	})


	// 验证码失去焦点事件
    $("input[name=code]").blur(function(){
        // 获取用户输入的验证码值
        var cv = $(this).val(); // console.log(cv);
        // 验证码不能为空
        if (cv == "") {
            $(".errorsssss").removeAttr("style").delay(2000).fadeOut(2000);
            CS = false;
            return;
        }

        // 发送ajax做比对验证码
        $.post("/home/ajaxpcodes", {codes:cv},function(data){
            console.log(data);
            if (data == 1) {
                CS = true;
            } else if (data == 0) {
                // 验证码错误
                $(".erroras").removeAttr("style").delay(2000).fadeOut(2000);
                CS = false;
            }
        })
    })
							
	
	// 按钮点击事件
	$("#submit").click(function(){

		$("input[name=phone_number]").trigger("blur");
		$("input[name=code]").trigger("blur");


			if (PS && CS) {
				return true;			
			} else {
				// alert(1);
				return false;
			}				
	})
</script>

</body>
</html>
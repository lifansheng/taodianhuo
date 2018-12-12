@extends("layout.person")
@section("title", $title)
@section("content")
<link href="/homes/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
<link href="/homes/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

<link href="/homes/css/personal.css" rel="stylesheet" type="text/css">
<link href="/homes/css/stepstyle.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="/homes/js/jquery-1.7.2.min.js"></script>
<script src="/homes/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">绑定手机</strong> / <small>Bind&nbsp;Phone</small></div>
					</div>
					<hr/>
					<!--进度条-->
					<div class="m-progress">
						<div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">绑定手机</p>
                            </span>
							<span class="step-2 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">完成</p>
                            </span>
							<span class="u-progress-placeholder"></span>
						</div>
						<div class="u-progress-bar total-steps-2">
							<div class="u-progress-bar-inner"></div>
						</div>
					</div>
					<form class="am-form am-form-horizontal" action="/home/dobindphone" method="post">
						{{csrf_field()}}
						<div class="am-form-group bind">
							<label for="user-phone" class="am-form-label">验证手机</label>
							<div class="am-form-content">
								<span id="user-phone" value="{{session('phone_number')}}">{{session("phone_number")}}</span>
							</div>
						</div>
						<div class="am-form-group code">
							<label for="user-code" class="am-form-label">验证码</label>
							<div class="am-form-content">
								<input type="tel" id="user-code" placeholder="短信验证码">
								<span></span>
							</div>
							<a class="btn" href="javascript:void(0);" id="sendMobileCode">
								<div class="am-btn am-btn-danger">验证码</div>
							</a>
						</div>
						<div class="am-form-group">
							<label for="user-new-phone" class="am-form-label">验证手机</label>
							<div class="am-form-content">
								<input type="tel" name="phone_number" id="user-new-phone" placeholder="绑定新手机号">
								<span></span>
							</div>
						</div>
						<div class="am-form-group code">
							<label for="user-new-code" class="am-form-label">验证码</label>
							<div class="am-form-content">
								<input type="tel" id="user-new-code" placeholder="短信验证码"><span></span>
							</div>
							<a class="btn" href="javascript:void(0);" id="sendMobileCode1">
								<div class="am-btn am-btn-danger">验证码</div>
							</a>
						</div>
						<div class="info-btn">
							<button id="but" class="am-btn am-btn-danger">保存修改</button>
						</div>

					</form>

				</div>
<script src="/admins/js/libs/jquery-3.3.1.min.js"></script>
<script>
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	// 设置ajax为同步
	$.ajaxSetup({async:false});

	var OCS = false;
	var NPS = false;
	var NCS = false;

	// 点击第一个验证码 将手机号码用过ajax发送出去 发送短信
	$("#sendMobileCode").click(function(){
		// 获取解绑的手机号码
		var upv = $("#user-phone").attr("value");		// console.log(upv);

		// 将该手机号码发送ajax
		$.post("/home/ajaxbindphone", {number:upv}, function(data){
			// console.log(data);
		})
	})

	// 解绑验证码失去焦点事件
	$("#user-code").blur(function(){
		var t = $(this);

		// 获取用户输入的验证码
		var cv = t.val();	// console.log(cv);

		if (cv == "") {
			// 不能为空
			t.next().text("验证码不允许为空").css("color", "red");
			t.css("border", "solid 2px red");
			OCS = false;
			return;
		} else {
			// ajax 对比验证码
			$.post("/home/ajaxbindphonecode", {code:cv}, function(data){
				// console.log(data);
				if (data == 1) {
					t.css("border", "solid 2px green");
					t.next().text("");
					OCS = true;
				} else {
					t.next().text("验证码错误").css("color", "red");
					t.css("border", "solid 2px red");	
					OCS = false;
				}
			})
		}
	})

	// 新号码失去焦点事件
	$("#user-new-phone").blur(function(){
		var t = $(this);

		// 获取用户输入的新号码的值
		var pv = t.val();	// console.log(pv);

		// 新号码不允许为空
		if (pv == "") {
			t.next().text("验证码不允许为空").css("color", "red");
			t.css("border", "solid 2px red");
			NPS = false;
			return;	
		}

		// 手机号正则
		var reg = /^(((13[0-9]{1})|(15[0-9]{1})|(16[0-9]{1})|(17[0-9]{1}|(18[0-9]{1})|(19[0-9]{1})))+\d{8})$/;

		// 判断手机号码是否符合正则
		if (!reg.test(pv)) {
			// 如果不符合提示手机号码不符合规则
			t.next().text("手机号码格式不正确").css("color", "red");
			t.css("border", "solid 2px red");
			NPS = false;
		} else {
			t.css("border", "solid 2px green");
			t.next().text("");
			NPS = true;
		}		
	})

	// 点击第二个验证码 将手机号码用过ajax发送出去 发送短信
	$("#sendMobileCode1").click(function(){
		// 获取新的手机号码
		var pv = $("#user-new-phone").val();		// console.log(pv);

		// 将该手机号码发送ajax 接收短信
		$.post("/home/ajaxbindphones", {number:pv}, function(data){
			// console.log(data);	
		})
	})

	// 绑定验证码失去焦点事件
	$("#user-new-code").blur(function(){
		var t = $(this);

		// 获取用户输入的验证码
		var cv = t.val();	// console.log(cv);

		if (cv == "") {
			// 不能为空
			t.next().text("验证码不允许为空").css("color", "red");
			t.css("border", "solid 2px red");
			NCS = false;
			return;
		} else {
			// ajax 对比验证码
			$.post("/home/ajaxbindphonecodes", {code:cv}, function(data){
				// console.log(data);
				if (data == 1) {
					t.css("border", "solid 2px green");
					t.next().text("");
					NCS = true;
				} else {
					t.next().text("验证码错误").css("color", "red");
					t.css("border", "solid 2px red");	
					NCS = false;
				}
			})
		}
	})

	// 提交表单
	$("#but").click(function(){
		$("#user-code").trigger("blur");
		$("#user-new-phone").trigger("blur");
		$("#user-new-code").trigger("blur");

		if (OCS && NPS && NCS) {
			return true;
		} else {
			return false;
		}
	})
</script>
@stop
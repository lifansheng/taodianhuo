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
				<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改密码</strong> / <small>Password</small></div>
			</div>
			<hr/>
			<!--进度条-->
			<div class="m-progress">
				<div class="m-progress-list">
					<span class="step-1 step">
                        <em class="u-progress-stage-bg"></em>
                        <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                        <p class="stage-name">重置密码</p>
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
			<form class="am-form am-form-horizontal" action="/home/dopsword" method="post">
				{{csrf_field()}}
				<div class="am-form-group">
					<label for="user-old-password" class="am-form-label">原密码</label>
					<div class="am-form-content">
						<input type="password" id="user-old-password" placeholder="请输入原登录密码">
						<span></span>
					</div>
				</div>
				<div class="am-form-group">
					<label for="user-new-password" class="am-form-label">新密码</label>
					<div class="am-form-content">
						<input type="password" name="password" id="user-new-password" placeholder="由6~18位数字、字母、下划线组合">
						<span></span>
					</div>
				</div>
				<div class="am-form-group">
					<label for="user-confirm-password" class="am-form-label">确认密码</label>
					<div class="am-form-content">
						<input type="password" id="user-confirm-password" placeholder="请再次输入上面的密码">
						<span></span>
					</div>
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

	var UOPS = false;
	var UNPS = false;
	var UNRPS = false;


	// 原密码失去焦点
	$("#user-old-password").blur(function(){
		var t = $(this);
		// 获取用输入的值
		var uop = $(this).val();	// console.log(uop);
		// 原密码不允许为空
		if (uop == "") {
			t.css("border", "solid 2px red")
			t.next().text("原密码不允许为空").css("color", "red")
			UOPS = false;
			return;
		} else {
			// 发送ajax与数据库做比对
			$.post("/home/ajaxuop", {uop:uop}, function(data){
				// console.log(data);
				if (data == 1) {
					t.css("border", "solid 2px green")
					t.next().text("")
					UOPS = true;
				} else {
					t.css("border", "solid 2px red")
					t.next().text("密码错误").css("color", "red")
					UOPS = false;
				}
			})
		}
	})

	// 新密码失去焦点
	$("#user-new-password").blur(function(){
		var t = $(this);
		// 获取用输入的值
		var unp = $(this).val();	// console.log(unp);

		// 获取原密码的值
		var uop = $("#user-old-password").val();	// console.log(uop);

		// 不允许为空
		if (unp == "") {
			t.css("border", "solid 2px red")
			t.next().text("新密码不允许为空").css("color", "red")
			UNPS = false;
			return;
		}

		// 正则
		var reg = /^\w{6,18}$/;

		if (!reg.test(unp)) {
				t.css("border", "solid 2px red")
				t.next().text("新密码不符合格式").css("color", "red")
				UNPS = false;
			} else if(unp == uop) {
				t.css("border", "solid 2px red")
				t.next().text("不允许与原密码相同").css("color", "red")
				UNPS = false;
			} else {
				t.css("border", "solid 2px green")
				t.next().text("")
				UNPS = true;
			}
	})

	// 确认密码失去焦点
	$("#user-confirm-password").blur(function(){
		var t = $(this);
		// 获取用户输入的值
		var unrp = $(this).val();	// console.log(unrp);

		// 同时获取用户输入新密码的值
		var unp = $("#user-new-password").val();	// console.log(unp);

		// 不能为空
		if (unrp == "") {
			t.css("border", "solid 2px red")
			t.next().text("确认密码不允许为空").css("color", "red")
			UNRPS = false;
			return;
		}

		if (unrp == unp) {
			t.css("border", "solid 2px green")
			t.next().text("")
			UNRPS = true;
		} else {
			t.css("border", "solid 2px red")
			t.next().text("两次密码输入不同").css("color", "red")
			UNRPS = false;
		}
	})
	
	// 提交表单
	$("#but").click(function(){
		$("#user-old-password").trigger("blur");
		$("#user-new-password").trigger("blur");
		$("#user-confirm-password").trigger("blur");

		if (UOPS && UNPS && UNRPS) {
			return true;
		} else {
			return false;
		}
	})
</script>
@stop
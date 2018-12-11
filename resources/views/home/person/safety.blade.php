@extends("layout.person")
@section("title", $title)
@section("content")
<link href="/homes/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
<link href="/homes/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
<link href="/homes/css/personal.css" rel="stylesheet" type="text/css">
<link href="/homes/css/infstyle.css" rel="stylesheet" type="text/css">
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<!--标题 -->
					<div class="user-safety">
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">账户安全</strong> / <small>Set&nbsp;up&nbsp;Safety</small></div>
						</div>
						<hr/>
						<div class="check">
							<ul>
								<li>
									<i class="i-safety-lock"></i>
									<div class="m-left">
										<div class="fore1">登录密码</div>
										<div class="fore2"><small>为保证您购物安全，建议您定期更改密码以保护账户安全。</small></div>
									</div>
									<div class="fore3">
										<a href="/home/psword">
											<div class="am-btn am-btn-secondary">修改</div>
										</a>
									</div>
								</li>
								<li>
									<i class="i-safety-iphone"></i>
									<div class="m-left">
										<div class="fore1">手机验证</div>
										<div class="fore2"><small>您验证的手机：{{session("phone_number")}}</small></div>
									</div>
									<div class="fore3">
										<a href="/home/bindphone">
											<div class="am-btn am-btn-secondary">换绑</div>
										</a>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
@stop
				
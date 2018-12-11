<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">


		<!-- xiangqiang -->

		<title>@yield('title')</title>
		<link href="/homes/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/homes/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />

		<link href="/homes/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/homes/css/cartstyle.css" rel="stylesheet" type="text/css" />
		<link href="/homes/css/optstyle.css" rel="stylesheet" type="text/css" />

		<link href="/homes/css/hmstyle.css" rel="stylesheet" type="text/css" />
		<script src="/homes/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="/homes/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>

		<script type="text/javascript" src="/homes/basic/js/jquery-1.7.min.js"></script>


	</head>

	<body>
		<div class="hmtop">
			<!--顶部导航条 -->
			<div class="am-container header">
				@php 
        		$user = DB::table("homes") -> where("hid", session("hid")) -> first();
    			@endphp
				@if($user)
					<ul class="message-l">
						<div class="topMessage">
							<div class="menu-hd">
								<a href="/home/person" target="_top" class="h">欢迎您,{{$user->username}}</a>&nbsp;&nbsp;<a href="/home/logout" target="_top">退出</a>
							</div>
						</div>
					</ul>
    			@else
					<ul class="message-l">
						<div class="topMessage">
							<div class="menu-hd">
								<a href="/home/login" target="_top" class="h">亲，请登录</a>
								<a href="/home/register" target="_top">免费注册</a>
							</div>
						</div>
					</ul>
				@endif
				<ul class="message-r">
					<div class="topMessage home">
						<div class="menu-hd"><a href="/home/leader" target="_top" class="h">购物向导</a></div>
					</div>
					<div class="topMessage home">
						<div class="menu-hd"><a href="/" target="_top" class="h">商城首页</a></div>
					</div>
					
					<div class="topMessage my-shangcheng">
						<div class="menu-hd MyShangcheng"><a href="/home/person" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
					</div>

					@if (session('hid'))


					@php
						$count = DB::table('shopcar') -> where('hid',session('hid')) -> count();
					@endphp
					<div class="topMessage mini-cart">
						<div class="menu-hd" id='haha'><a id="mc-menu-hd" href="javascript:void(0)" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">{{$count}}</strong></a></div>
					</div>
					<div class="topMessage favorite">
						<div class="menu-hd" id='heihei'><a href="javascript:void(0);" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
					@else
					<div class="topMessage mini-cart">
						<div class="menu-hd" id='hehe'><a id="mc-menu-hd" href="javascript:void(0)" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
					</div>
					<div class="topMessage favorite">
						<div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
					@endif
				</ul>
			</div>

			<!--悬浮搜索框-->

			<div class="nav white">
				<div class="logo"><img src="/homes/images/logo.png" /></div>
				<div class="logoBig">

							@php use App\Http\Controllers\Home\HomeController;
									$sites  = HomeController::fulei();
									
						   			
							@endphp
					@foreach($sites as $v)
					<li><img src="{{$v -> logo}}" /></li>
					@endforeach
				</div>
					

				<div class="search-bar pr">
					<a name="index_none_header_sysc" href="home/search"></a>
					<form action="/home/search">
						<input id="searchInput" name="gname" type="text" placeholder="只要小店有的,都给你" autocomplete="off" >
						<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
					</form>
				</div>
			</div>
			<div class="clear"></div>
		</div>

	@section('content')		        				
							
	@show
				</div>
			</div>
					<div class="footer ">
						<div class="footer-hd ">
								@php
									$links  = HomeController::fulei2();
									
									
								@endphp							
							<p>
								@foreach($links as $v)
									<a href="{{$v->lurl}}" title="">
									<!-- <img src="{{$v->lpic}}" alt="" width="23px" height="23px" title="{{$v->lname}}"> -->
									{{$v->lname}}</a>
									<b>|</b>
								@endforeach
							</p>
						</div>
						<div class="footer-bd ">
							<p>
								<a href="/home/about">关于我们</a>
								<a href="javascript:void(0)">合作伙伴</a>
								<a href="javascript:void(0)">联系我们</a>
								<a href="JavaScript:void(0)">网站地图</a>
								<em>© 2015-2025 tao.cn 版权所有.  <a href="tao.cn" target="_blank" title="淘点货">淘点货</a> - Collect from <!-- <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></em> -->
							</p>
						</div>
					</div>
		<!--引导 -->

		<div class="navCir">
			<li class="active"><a href="home3.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="../person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>
		<!--菜单 -->
		<div class=tip>
			<div id="sidebar">
				<div id="wrap">
					@php 
	        		$user = DB::table("homes") -> where("hid", session("hid")) -> first();
	    			@endphp
	    			@if($user)
	    			<div id="prof" class="item ">
						<a href="/home/person">
							<span class="setting "></span>
						</a>

						<div class="ibar_login_box status_login ">
							<div class="avatar_box ">
								<p class="avatar_imgbox "><img src="{{$user->pic}}" /></p>
								<ul class="user_info ">
									<li>{{$user->username}}</li>
									<li>级&nbsp;别：普通会员</li>
								</ul>
							</div>
							<div class="login_btnbox ">
								<a href="# " class="login_order ">我的订单</a>
								<a href="# " class="login_favorite ">我的收藏</a>
							</div>
							<i class="icon_arrow_white "></i>
						</div>
					</div>

					<div id="shopCart " class="item cartss">
						<a href="javascript:void(0)">
							<span class="message "></span>
						</a>
						<p>
							购物车
						</p>
						<p class="cart_num ">{{$count}}</p>
					</div>

	    			@else
					<div id="prof" class="item ">
						<a href="# ">
							<span class="setting "></span>
						</a>

						<div class="ibar_login_box status_login ">
							<div class="avatar_box ">
								<p class="avatar_imgbox "><img src="/homes/images/no-img_mid_.jpg " /></p>
								<ul class="user_info ">
									<li>用户名：sl1903</li>
									<li>级&nbsp;别：普通会员</li>
								</ul>
							</div>
							<div class="login_btnbox ">
								<a href="# " class="login_order ">我的订单</a>
								<a href="# " class="login_favorite ">我的收藏</a>
							</div>
							<i class="icon_arrow_white "></i>
						</div>
					</div>

					<div id="shopCart " class="item gologin">
						<a href="javascript:void(0)">
							<span class="message "></span>
						</a>
						<p>
							购物车
						</p>
						<p class="cart_num ">0</p>
					</div>
					@endif
					<div id="asset " class="item ">
						<a href="# ">
							<span class="view "></span>
						</a>
						<div class="mp_tooltip ">
							我的资产
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>
					<div id="foot " class="item ">
						<a href="# ">
							<span class="zuji"></span>
						</a>
						<div class="mp_tooltip ">
							我的足迹
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="brand " class="item ">
						<a href="/home/collection">
							<span class="wdsc "><img src="/homes/images/wdsc.png " /></span>
						</a>
						<div class="mp_tooltip ">
							我的收藏
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="broadcast " class="item ">
						<a href="# ">
							<span class="chongzhi "><img src="/homes/images/chongzhi.png " /></span>
						</a>
						<div class="mp_tooltip ">
							我要充值
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div class="quick_toggle ">
						<li class="qtitem ">
							<a href="# "><span class="kfzx "></span></a>
							<div class="mp_tooltip ">客服中心<i class="icon_arrow_right_black "></i></div>
						</li>
						<!--二维码 -->
						<li class="qtitem ">
							<a href="#none "><span class="mpbtn_qrcode "></span></a>
							<div class="mp_qrcode " style="display:none; "><img src="/homes/images/weixin_code_145.png " /><i class="icon_arrow_white "></i></div>
						</li>
						<li class="qtitem ">
							<a href="#top " class="return_top "><span class="top "></span></a>
						</li>
					</div>

					<!--回到顶部 -->
					<div id="quick_links_pop " class="quick_links_pop hide "></div>

				</div>

			</div>
			<div id="prof-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					我
				</div>
			</div>
			<div id="shopCart-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					购物车
				</div>
			</div>
			<div id="asset-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					资产
				</div>

				<div class="ia-head-list ">
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">优惠券</div>
					</a>
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">红包</div>
					</a>
					<a href="# " target="_blank " class="pl money ">
						<div class="num ">￥0</div>
						<div class="text ">余额</div>
					</a>
				</div>

			</div>
			<div id="foot-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					足迹
				</div>
			</div>
			<div id="brand-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					收藏
				</div>
			</div>
			<div id="broadcast-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					充值
				</div>
			</div>
		</div>
		<script>
			window.jQuery || document.write('<script src="/homes/basic/js/jquery.min.js "><\/script>');
		</script>
		<script type="text/javascript " src="/homes/basic/js/quick_links.js "></script>
		<script type="text/javascript" src="/homes/js/jquery.js"></script>
		<script type="text/javascript">
			$('.cartss').bind('click',function(){
				location.href="/home/carts";
			})

			$('#haha').bind('click',function(){
				location.href="/home/carts";
			})

			$('#heihei').bind('click',function(){
				location.href="/home/collection";
			})

			$('.gologin').click(function(){
				alert('请先去登陆...');
				setTimeout(function(){
					location.href="/home/login";
				},10);
			})

			$('#hehe').click(function(){
				alert('请先去登陆...');
				setTimeout(function(){
					location.href="/home/login";
				},10);
			})
		</script>
@section('js')


@show
	</body>	
</html>
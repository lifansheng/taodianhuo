<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home.welcome');
// });

//后台的登录
Route::any("admin/login", "Admin\LoginController@login");
Route::any("admin/dologin", "Admin\LoginController@dologin");
Route::any("admin/captcha", "Admin\LoginController@captcha");
Route::any('admin/upload','Admin\LunboController@upload');

//后台的修改已登录管理员的头像
Route::any("admin/pic", "Admin\LoginController@pic");
Route::any("admin/uploads", "Admin\LoginController@uploads");

//改密码
Route::any("admin/changepass", "Admin\LoginController@changepass");
Route::any("admin/changenewpass", "Admin\LoginController@changenewpass");

//退出登录
Route::any("admin/logout", "Admin\LoginController@logout");

// 双击商品的修改图片 goods
route::get('/admin/goodsajaxs','Admin\GoodsController@xiugai');
//修改主图片
route::any('/admin/edituajax','Admin\GoodsController@xiutu');
//后台
Route::group(["middleware" => ["login", "userper"]], function(){
 
	//后台的首页

	Route::get('/admin', 'Admin\IndexController@index');
	Route::get('/admin/index', 'Admin\IndexController@index');

	//后台的管理员管理
	Route::resource('admin/user',"Admin\UserController");
	Route::get('/admin/usajax','Admin\UserController@ajaxupdate');

	// 前台的用户管理
	Route::resource('admin/homeuser',"Admin\HomeuserController");
	// ajax
	Route::post("admin/ajaxhomeusername", "Admin\HomeuserController@ajaxhomeusername");
	Route::post("admin/ajaxhomephone", "Admin\HomeuserController@ajaxhomephone");
	Route::post("admin/ajaxhomeemail", "Admin\HomeuserController@ajaxhomeemail");
	Route::get('admin/homeuserajax','Admin\HomeuserController@homeuserajax');

	// 角色管理
	Route::resource("admin/role", "Admin\RoleController");
	// 添加角色
	Route::any("admin/user_role", "Admin\UserController@user_role");
	Route::any("admin/do_user_role", "Admin\UserController@do_user_role");
	// 添加权限
	Route::any("admin/role_per", "Admin\RoleController@role_per");
	Route::any("admin/do_role_per", "Admin\RoleController@do_role_per");
	

	// 权限管理
	Route::resource("admin/permission", "Admin\PermissionController");

	//友情链接
	Route::resource('admin/link', 'Admin\LinkController');

	//商品的分类管理
	route::resource('admin/cate','Admin\CateController');
	//商品的管理
	route::resource('admin/goods','Admin\GoodsController');

	///admin/goodsajax
	// route::get("admin/goodsajax", "Admin\GoodsController@goodsajax");

	//商品的评论管理
	route::resource('admin/comment','Admin\CommentController');

	// 后台的轮播图管理
	Route::resource('admin/lunbo','Admin\LunboController');
	

	// 后台订单管理
	Route::resource('admin/a_order','Admin\OrderController');
	// 后台订单详情
	Route::get('admin/details/{oid}','Admin\OrderController@details');
	Route::get('admin/fahuo/{oid}','Admin\OrderController@fahuo');

	//友情链接
	Route::resource('admin/link', 'Admin\LinkController');

	//ajax
	Route::get('admin/lkajax','Admin\LinkController@ajaxupdate');

	

	//后台的新闻
	route::resource('admin/news','Admin\NewsController');


	// 广告管理
	Route::resource("admin/advert", "Admin\AdvertController");
	Route::get('/admin/advajax','Admin\AdvertController@ajaxupdate');
	Route::any("admin/advuploads", "Admin\AdvertController@uploads");



	//网站配置
	Route::resource('admin/site','Admin\SiteController');
	// Route::any('admin/site:id','Admin\SiteController@show');


	//收货信息
	Route::resource('admin/address','Admin\AddressController');

	
});
	// 没有权限时的跳转页面
	Route::get("admin/remind", "Admin\UserController@remind");



//前台
// Route::get('/',function(){
// 	return view('home.index',['title'=>'淘点货']);
// });
route::any('/','Home\HomeController@index');

//前台分类
// route::get('')


// 详情页面
Route::get('home/details','Home\HomeController@details');

Route::get('home/advert','Admin\AdvertController@homeadvert');

//搜索后出来的页面
route::get('home/search','Home\HomeController@search');

route::get('homes/search','Home\HomeController@list');
//向导
route::get('home/leader','Home\HomeController@leader');

// 前台登录、注册页面
Route::any("home/login", "Home\LoginController@login");
Route::any("home/register", "Home\LoginController@register");
Route::any("home/dologin", "Home\LoginController@dologin");
Route::any("home/do_fp", "Home\LoginController@do_fp");
Route::any("home/do_rp", "Home\LoginController@do_rp");
Route::any("home/signup", "Home\LoginController@signup");
Route::any("home/captcha", "Home\LoginController@captcha");
Route::get("home/tixing", "Home\LoginController@tixing");
Route::post("home/ajaxhname", "Home\LoginController@ajaxhname");
Route::post("home/ajaxemails", "Home\LoginController@ajaxemail");
Route::post("home/ajaxphone", "Home\LoginController@ajaxphone");
// Route::post("home/ajaxcode", "Home\LoginController@ajaxcode");

Route::post("home/ajaxpcode", "Home\LoginController@ajaxpcode");
Route::post("home/ajaxpcodes", "Home\LoginController@ajaxpcodes");

Route::post("home/ajaxcontrastname", "Home\LoginController@ajaxcontrastname");


// 忘记密码
Route::any("home/forget_password", "Home\LoginController@forget_password");

Route::group(["middleware" => "home_login"], function(){

	//关于我们
	route::get('/home/about','Home\HomeController@about');

	//退出登录
	Route::any("home/logout", "Home\LoginController@logout");

	// 个人中心
	Route::get('home/person','Home\PersonController@pindex');

	//个人信息
	Route::resource('home/personinformation','Home\PersonController');

	//收货地址
	Route::resource('home/address','Home\AddressController');

	Route::post('home/addressajax','Home\AddressController@adajax');

	// 订单结算成功页面
	Route::get("home/cheng","Home\CartsController@cheng");

	// 订单结算页面
	Route::post("home/jiesuan","Home\CartsController@index");

	// 点击设置默认地址
	Route::get("home/addrdefault","Home\OrderController@addrdefault");

	// 订单中心
	Route::any("home/order","Home\OrderController@index");

	// 我的收藏添加
	Route::post("home/shoucang","Home\CollectController@shoucang");
	// 我的收藏删除
	Route::get("home/qushoucang","Home\CollectController@qushoucang");
	// 我的收藏加载更多
	Route::get("home/gengduo","Home\CollectController@gengduo");
	// 前台购物车的添加
	Route::get("home/addCar","Home\CartsController@addCar");
	// 购物车的显示
	Route::get("home/carts","Home\CartsController@shopcar");
	// 购物车的加运算
	Route::get("home/carAdd","Home\CartsController@carAdd");
	// 购物车的减运算
	Route::get("home/carJian","Home\CartsController@carJian");
	Route::get("home/shopcart","Home\CartsController@shopcart");
	// 立即购买
	Route::get("home/liGo","Home\CartsController@liGo");

	// 购买时检测是否有收货地址
	Route::get("home/ifaddr","Home\CartsController@ifaddr");

	// 订单中心
	Route::any("home/order","Home\OrderController@index");
	Route::get("home/orderxiang","Home\OrderController@orderxiang");
	Route::get("home/shouorder","Home\OrderController@queren");
	Route::get("home/shanorder","Home\OrderController@shanorder");
	Route::post("home/tixing","Home\OrderController@tixing");

	// 我的收藏
	Route::any("home/collection","Home\CollectController@index");


	// Route::post('ho/person','Home\PersonController@upload');

	//个人中心评价
	route::any('home/comments','Home\CommentController@comment');
	//添加评论
	route::any('home/comment','Home\CommentController@create');
	//查看个人所有的而评论
	// route::any('home/all','Home\CommentController@all');

	// 我的足迹
	Route::any("home/footprint", "Home\FootprintController@footprint");
	// 删除足迹
	Route::any("/home/ajaxcheckfoots", "Home\FootprintController@ajaxcheckfoots");
	// 清空足迹
	Route::any("/home/ajaxcheckfootss", "Home\FootprintController@ajaxcheckfootss");

	// 安全设置
	Route::any("home/safety", "Home\PersonController@safety");
	// 修改登录密码的页面
	Route::any("home/psword", "Home\PersonController@psword");
	// 修改登录密码的方法
	Route::post("home/dopsword", "Home\PersonController@dopsword");
	// ajax 原密码
	Route::post("/home/ajaxuop", "Home\PersonController@ajaxuop");

	// 绑定手机的页面
	Route::any("home/bindphone", "Home\PersonController@bindphone");
	// 绑定手机的方法
	Route::any("home/dobindphone", "Home\PersonController@dobindphone");
	// ajax 解绑手机号码
	Route::post("/home/ajaxbindphone", "Home\PersonController@ajaxbindphone");
	// ajax 解绑验证码
	Route::post("/home/ajaxbindphonecode", "Home\PersonController@ajaxbindphonecode");
	// ajax 新绑定手机号码
	Route::post("/home/ajaxbindphones", "Home\PersonController@ajaxbindphones");
	// ajax 绑定验证码
	Route::post("/home/ajaxbindphonecodes", "Home\PersonController@ajaxbindphonecodes");
});




	



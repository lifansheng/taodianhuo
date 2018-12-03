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


//后台的修改已登录管理员的头像
Route::any("admin/pic", "Admin\LoginController@pic");
Route::any("admin/uploads", "Admin\LoginController@uploads");

//改密码
Route::any("admin/changepass", "Admin\LoginController@changepass");
Route::any("admin/changenewpass", "Admin\LoginController@changenewpass");

//退出登录
Route::any("admin/logout", "Admin\LoginController@logout");


//后台
Route::group(["middleware" => "login"], function(){
 
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

	//友情链接
	Route::resource('admin/link', 'Admin\LinkController');

	//商品的分类管理
	route::resource('admin/cate','Admin\CateController');
	//商品的管理
	route::resource('admin/goods','Admin\GoodsController');
	//商品的评论管理
	route::resource('admin/comment','Admin\CommentController');

	// 后台的轮播图管理
	Route::resource('admin/lunbo','Admin\LunboController');
	Route::any('/admin/upload','Admin\LunboController@upload');

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


// 前台登录、注册页面
Route::any("home/login", "Home\LoginController@login");
Route::any("home/register", "Home\LoginController@register");
Route::any("home/dologin", "Home\LoginController@dologin");
Route::any("home/signup", "Home\LoginController@signup");
Route::any("home/captcha", "Home\LoginController@captcha");
Route::get("home/tixing", "Home\LoginController@tixing");
Route::post("home/ajaxhname", "Home\LoginController@ajaxhname");
Route::post("home/ajaxemails", "Home\LoginController@ajaxemail");
Route::post("home/ajaxphone", "Home\LoginController@ajaxphone");
Route::post("home/ajaxcode", "Home\LoginController@ajaxcode");

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

// 订单结算页面
Route::post("home/jiesuan","Home\CartsController@index");
// 订单结算成功页面
Route::get("home/cheng","Home\CartsController@cheng");

// 前台
Route::group(["middleware" => "login"], function(){
	// ajax验证注册用户名
	


	//个人中心
Route::get('home/person','Home\PersonController@index');
});




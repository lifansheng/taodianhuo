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
Route::any("admin/upload", "Admin\LoginController@upload");

//改密码
Route::any("admin/changepass", "Admin\LoginController@changepass");
Route::any("admin/changenewpass", "Admin\LoginController@changenewpass");

//退出登录
Route::any("admin/logout", "Admin\LoginController@logout");


//后台
Route::group(["middleware" => "login"], function(){
 
	//后台的首页
	Route::get('/admin', 'Admin\IndexController@indexs');

	//后台的用户管理
	Route::resource('admin/user',"Admin\UserController");
	Route::get('/admin/usajax','Admin\UserController@ajaxupdate');


	//友情链接
	Route::resource('admin/link', 'Admin\LinkController');

	//商品的分类管理
	route::resource('admin/cate','Admin\CateController');
	//商品的管理
	route::resource('admin/goods','Admin\GoodsController');

	// 后台的轮播图管理
	Route::resource('admin/lunbo','Admin\LunboController');
	Route::any('/admin/upload','Admin\LunboController@upload');

	//友情链接
	Route::resource('admin/link', 'Admin\LinkController');

	//ajax
	Route::get('admin/lkajax','Admin\LinkController@ajaxupdate');

	

	
});
//网站配置
	Route::get('admin/site','Admin\SiteController@index');
//前台
		Route::get('/',function(){
			return view('home.index');
		});

		// 列表页
	Route::get('home/details','Home\HomeController@details');

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

Route::get('/', function () {
    return view('home.welcome');
});

//后台的登录
Route::any("admin/login", "Admin\LoginController@login");
Route::any("admin/dologin", "Admin\LoginController@dologin");
Route::any("admin/captcha", "Admin\LoginController@captcha");


//后台
Route::group([], function(){

	//后台的首页
	Route::get('/admin', 'Admin\IndexController@index');

	//后台的用户管理
	Route::resource('admin/user',"Admin\UserController");
	Route::get('/admin/usajax','Admin\UserController@ajaxupdate');

	//商品的分类管理
	route::resource('admin/cate','Admin\CateController');
	//商品的管理
	route::resource('admin/goods','Admin\GoodsController');


	// 后台的轮播图管理
	Route::resource('admin/lunbo','Admin\LunboController');
	Route::any('/admin/upload','Admin\LunboController@upload');

});

//前台

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

/*后台路由*/

// 后台登录、注销
Route::get('/logins', 'LoginController@index');
Route::post('/logins','LoginController@login');
Route::get('/logout', 'LoginController@logout');

// 中间件权限控制
Route::group(['middleware' => 'logins'], function() {
	// 后台主页
	Route::resource('admins', 'AdminController');
	// 用户管理
	Route::resource('users', 'UserController');
	// 分类管理
	Route::resource('cates', 'CateController');
	// 标签管理
	Route::resource('tags', 'TagController');
	// 文章管理
	Route::resource('articles', 'ArticleController');	
});

/*前端路由*/

// 前端首页
Route::get('/', 'ArticleController@lists');

// 文章的详情显示页面
Route::get('/article/{id}.html', [
	'uses'=>'ArticleController@show',
	'as'=>'detail'
	]);


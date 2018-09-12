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
    return view('welcome');
});

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
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class LoginController extends Controller
{
    /*后台登录界面*/
    public function index()
    {
    	return view('admin.login.login');
    }
    /*实现登录*/
    public function login(Request $request)
    {
    	// 实例化用户对象
    	$user = User::where('username', $request->username)->firstOrFail();
    	// 获取用户信息
    	if (Hash::check($request->password, $user->password)) {
    		// 写入登录状态
    		session(['uid' => $user->id]);
    		return redirect('/admins')->with('info', '欢迎登录'.$user->name);
    	} else  {
    		return redirect()->back();
    	}
    }
    /*注销*/
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/logins');
    }
}

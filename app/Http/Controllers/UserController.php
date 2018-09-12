<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class UserController extends Controller
{
    /*用户添加页面*/
    public function create()
    {
    	return view('admin.user.create');
    }

    /*用户数据插入*/
    public function store(Request $request)
    {
    	// 表单验证
    	$this->validate($request, [
        	'username' => 'required|regex:/\w{4,16}/',
        	'email' => 'required|email',
        	'password' => 'required|same:repassword',
        ],[
        	'username.required' => '用户名为必填项',
        	'username.regex' => '请填写4~16位字母数字下划线',
        	'email.required' => '邮箱为必填项',
        	'email.email' => '邮箱格式不正确',
        	'password.required' => '密码为必填项',
        	'password.same' => '两次密码不一致',
        ]);
        // 数据插入
    	$user = new User;
    	$user->username = $request->input('username');
    	$user->email = $request->input('email');
    	$user->password = Hash::make($request->input('password'));
    	$user->intro = $request->input('intro');
    	// 随机字符串标识
    	$user->remember_token = str_random(50);
    	// 处理图片上传
		if ($request->hasFile('profile')) {
		    // 文件的存放目录
		    $path = './uploads/'.date('Ymd');
		    // 获取文件后缀名
			$extension = $request->profile->extension();
			// 文件的名称
			$fileName = time().rand(1000, 9999).'.'.$extension;
            // 保存文件 	
			$request->file('profile')->move($path, $fileName);
            // 拼接文件上传后路径
			$user->profile = trim($path.'/'.$fileName, '.');
		}
    	// 执行插入--此处如果报错Inflector.php,将php版本更新到最新即可
    	if ($user->save()) {
    		return redirect('/users')->with('info', '添加成功！');
    	} else {
    		return redirect()->back()->with('info', '添加失败！');
		}
    }

    /*用户列表页面*/
    public function index(Request $request)
    {
        $users = User::orderBy('id','desc')
        	// 检索的条件
            ->where(function($query) use ($request){
                //获取关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)) {
                    $query->where('username','like','%'.$keyword.'%');
                }
            })
            // 每页显示数量
            ->paginate($request->input('num', 10));
        // 解析模板、分配变量
    	return view('admin.user.index', ['users'=>$users, 'request'=>$request]);
    }

    /*用户修改页面*/
    public function edit($id)
    {
        //读取用户的信息
        $info = User::findOrFail($id);

        $user = User::get();
        // 解析模板
        return view('admin.user.edit', ['info'=>$info, 'user'=>$user]);
    }

    /*用户数据修改*/
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->intro = $request->intro;
        // 处理图片上传
		if ($request->hasFile('profile')) {
		    // 文件的存放目录
		    $path = './uploads/'.date('Ymd');
		    // 获取文件后缀名
			$extension = $request->profile->extension();
			// 文件的名称
			$fileName = time().rand(1000, 9999).'.'.$extension;
            // 保存文件 	
			$request->file('profile')->move($path, $fileName);
            // 拼接文件上传后路径
			$user->profile = trim($path.'/'.$fileName, '.');
		}
		// 执行插入--此处如果报错Inflector.php,将php版本更新到最新即可
    	if ($user->save()) {
    		return redirect('/users')->with('info', '用户信息修改成功！');
    	} else {
    		return redirect()->back()->with('info', '用户信息修改失败！');
		}
    }

   /*用户删除*/
    public function destroy($id)
    {
        //创建模型
        $user = User::findOrFail($id);
        //读取用户的头像信息
        $profile = $user->profile;
        $path = '.'.$profile;
        if (file_exists($path)) {
            unlink($path);
        }
        // 执行删除
        if ($user->delete()) {
            return redirect()->back()->with('info', '用户删除成功！');
        } else {
            return redirect()->back()->with('info', '用户删除失败！');
        }
    }

}

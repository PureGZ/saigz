<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cate;
use DB;

class CateController extends Controller
{
    /*显示分类列表*/
    public function index(Request $request)
    {        
        // 读取分类
        $cates = self::getCates();
        // 解析模板
        return view('admin.cate.index', ['cates'=>$cates, 'request'=>$request]);
    }

    /*获取所有的分类信息并且排序*/
    public static function getCates()
    {
        // 读取分类
        $cates = Cate::select(
            DB::raw('*, concat(path,"_",id) as paths'))->orderBy('paths')->get();
        // 遍历数组，调整分类名
        foreach ($cates as $key => $value) {
            // 判断当前分类等级
            $tmp = count(explode('_', $value->path)) - 1;
            $prefix = str_repeat('$~', $tmp);
            $value -> name = $prefix.$value->name;
        }
        return $cates;
    }

    /*创建分类页面*/
    public function create()
    {
        // 读取所有分类
        $cates = Cate::get();
        // 解析模板
        return view('admin.cate.create', ['cates' => $cates]);
    }

    /*将分类信息存入数据库*/
    public function store(Request $request)
    {

        $data = $request -> all();
        // 如果添加的是顶级分类，pid和path都是0
        if ($data['pid'] == 0) {
            $data['path'] = '0';
        }else {
            // 如果不是顶级分类，读取父级分类的信息
            $info = Cate::find($data['pid']);
            $data['path'] = $info->path.'_'.$info->id;
        }
        // 创建模型
        $cate = new Cate;
        $cate->name = $data['name'];
        $cate->pid = $data['pid'];
        $cate->path = $data['path'];
        // 执行插入
        if ($cate->save()) {
            return redirect('/cates')->with('info', '分类添加成功！');
        } else {
            return redirect()->back()->with('info', '分类添加失败！');
        } 
    }

    /**/
    public function show($id)
    {
        # code...
    }

    /*分类修改页面*/
    public function edit($id)
    {
        // 读取当前分类信息
        $info = Cate::findOrFail($id);
        // 读取
        $cates = Cate::get();
        // 解析模板
        return view('admin.cate.edit', ['info'=>$info, 'cates'=>$cates]);
    }

    /*分类数据修改*/
    public function update(Request $request, $id)
    {
        $cate = Cate::findOrFail($id);
        $cate->name = $request->name;
        $cate->pid = $request->pid;
        if ($cate->save()) {
            return redirect('/cates')->with('info', '分类更新成功！');
        } else {
            return redirect()->back()->with('info', '分类更新失败！');
        }
    }

    /*分类数据删除*/
    public function destroy($id)
    {
        // 删除分类
        $cate = Cate::findOrFail($id);
        // 删除子集分类
        $path = $cate->path.'_'.$cate->id;
        DB::table('cates')->where('path','like',$path.'%')->delete();
        if ($cate->delete()) {
            return redirect()->back()->with('info', '分类删除成功！');
        } else {
            return redirect()->back()->with('info', '分类删除失败！');
        }
    }
}
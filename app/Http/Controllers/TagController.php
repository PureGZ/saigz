<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use DB;

class TagController extends Controller
{
    /*显示标签列表*/
    public function index(Request $request)
    {
        // 数据分页显示
        $tags = Tag::orderBy('id','desc')
            ->where(function($query) use ($request) {
                // 获取关键字
                $keyword = $request->input('keyword');
                // 检测参数
                if (!empty($keyword)) {
                    $query->where('name', 'like','%'.$keyword.'%');
                }
            })
            ->paginate($request->input('num', 10));
        // 解析模板
        return view('admin.tag.index', ['tags'=>$tags, 'request'=>$request]);
    }

    /*获取所有的标签信息并且排序*/
    public static function getTags()
    {
        return Tag::orderBy('id','desc')->get();
    }

    /*创建标签页面*/
    public function create()
    {
        // 解析模板
        return view('admin.tag.create');
    }

    /*将标签信息存入数据库*/
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags'
        ],[
            'name.required' => '标签名不能为空',
            'name.unique' => '标签名已经存在'
        ]);
        // 创建模型
        $tag = new Tag;
        $tag -> name = $request->input('name');
        //  执行插入
        if ($tag->save()) {
            return redirect('/tags')->with('info', '标签添加成功！');
        } else {
            return redirect()->back()->with('info', '标签添加失败！');
        } 
    }

    /**/
    public function show($id)
    {
        # code...
    }

    /*将数据引入标签信息修改界面*/
    public function edit($id)
    {
        // 读取当前标签信息
        $info = Tag::findOrFail($id);
        // 读取
        $tags = Tag::get();
        // 解析模板
        return view('admin.tag.edit', ['info'=>$info, 'tags'=>$tags]);
    }

    /*标签数据更新*/
    public function update(Request $request, $id)
    {
        // 创建模型
        $tag = Tag::findOrFail($id);
        // 修改对象属性
        $tag->name = $request->name;
        // 执行插入
        if ($tag->save()) {
            return redirect('/tags')->with('info', '标签更新成功！');
        } else {
            return redirect()->back()->with('info', '标签更新失败！');
        }
    }

    /*标签数据删除*/
    public function destroy($id)
    {
        // 删除标签
        $tag = Tag::findOrFail($id);
        if ($tag->delete()) {
            return redirect()->back()->with('info', '标签删除成功！');
        } else {
            return redirect()->back()->with('info', '标签删除失败！');
        }
    }
}

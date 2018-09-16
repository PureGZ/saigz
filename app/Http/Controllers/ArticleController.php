<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use DB;

class ArticleController extends Controller
{
    /*显示文章列表*/
    public function index(Request $request)
    {       
        // 数据分页显示
        $articles = Article::orderBy('id','desc')
            ->where(function($query) use ($request) {
                // 获取关键字
                $keyword = $request->input('keyword');
                // 检测参数
                if (!empty($keyword)) {
                    $query->where('title', 'like','%'.$keyword.'%');
                }
            })
            ->paginate($request->input('num', 10));
        // 解析模板
        return view('admin.article.index', ['articles'=>$articles, 'request'=>$request]);
    }

    /*创建文章页面*/
    public function create()
    {
        // 读取分类信息
        $cates = CateController::getCates();
        //  读取标签信息
        $tags = TagController::getTags();
        // 解析模板
        return view('admin.article.create', [
            'cates' => $cates,
            'tags' => $tags
        ]);
    }

    /*将文章信息存入数据库*/
    public function store(Request $request)
    {
        // 创建模型
        $article = new Article;
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->cate_id = $request->input('cate_id');
        // 当前用户登录之后需要将用户的uid写入session中
        $article->user_id = 1;
        // $article->user_id = session('uid');
        // 检测是否有文件上传
        if ($request->hasFile('img')) {
            // 文件的存放目录
            $path = './uploads/'.date('Ymd');
            // 获取文件后缀名
            $extension = $request->img->extension();
            // 文件的名称
            $fileName = time().rand(1000, 9999).'.'.$extension;
            // 保存文件  
            $request -> file('img')->move($path, $fileName);
            // 拼接文件上传后路径
            $article->img = trim($path.'/'.$fileName, '.');
        }
        if ($article->save()) {
            // 将tag数据存入中间表Article_tag
            if ($article->tag()->sync($request->tag_id)) {
                return redirect('/articles')->with('info', '文章添加成功！');
            }        
        } else {
            return redirect()->back()->with('info', '文章添加失败！');
        } 
    }

    /*显示文章详情页面*/
    public function show($id)
    {
        // 读取文章信息
        $article = Article::findOrFail($id);
        // 显示文章详情
        return view('home.detail', ['article'=>$article]);
    }

    /*将数据引入文章信息修改界面*/
    public function edit($id)
    {
        // 读取当前文章信息
        $info = Article::findOrFail($id);
        $cates = CateController::getCates();
        $tags = TagController::getTags();
        // 获取该当前文章的所有标签
        $allTags = $info->tag->toArray();
        $ids = [];
        foreach ($allTags as $key => $value) {
            $ids[] = $value['id'];
        }
        // 解析模板
        return view('admin.article.edit', [
            'info'=>$info,
            'cates'=>$cates,
            'tags'=>$tags,
            'ids'=>$ids,
        ]);
    }

    /*文章数据更新*/
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->cate_id = $request->input('cate_id');
        // 检测是否有文件上传
        if ($request->hasFile('img')) {
            // 文件的存放目录
            $path = './uploads/'.date('Ymd');
            // 获取文件后缀名
            $extension = $request->img->extension();
            // 文件的名称
            $fileName = time().rand(1000, 9999).'.'.$extension;
            // 保存文件  
            $request -> file('img')->move($path, $fileName);
            // 拼接文件上传后路径
            $article->img = trim($path.'/'.$fileName, '.');
        }
        if ($article->save()) {
            // 将tag数据存入中间表Article_tag
            if ($article->tag()->sync($request->tag_id)) {
                return redirect('/articles')->with('info', '文章修改成功！');
            }        
        } else {
            return redirect()->back()->with('info', '文章修改失败！');
        } 
    }

    /*文章数据删除*/
    public function destroy($id)
    {
        // 获取模型
        $article = Article::findOrFail($id);
        // 删除文章主图
        @unlink('.'.$article->img);
        // 删除文章信息
        if ($article->delete()) {
            return redirect()->back()->with('info', '文章删除成功！');
        } else {
            return redirect()->back()->with('info', '文章删除失败！');
        }
    }

    /*前端文章列表显示*/
    public function lists()
    {
        // 读取文章列表
        $articles = Article::orderBy('id', 'desc')->paginate(5);
        // 显示列表
        return view('home.lists', ['articles'=>$articles]);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /*属于该文章的标签 tag-post：多对多*/
    public function tag()
    {
        return $this->belongsToMany('App\Tag');
    }
    /*属于该文章的分类 cate-post：一对多*/
    public function cate()
    {
        return $this->belongsTo('App\Cate');
    }
    /*属于该文章的分类 cate-post：一对多*/
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}

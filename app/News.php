<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = ['category_id', 'name', 'coverPic', 'description', 'content', 'status', 'sort'];//开启白名单字段
    const STATUS_NO = 0; //不显示
    const STATUS_YES = 1; //显示

    public function statusAlias($flag = false)
    {
        $maps = [
            self::STATUS_NO => '不显示',
            self::STATUS_YES => '显示',
        ];

        if ($flag) {
            return $maps;
        }

        return array_key_exists($this->status, $maps) ? $maps[$this->status] : '';
    }

    //一个分类下，有多条新闻，叫一对多关联hasMany  =》 反过来，就叫belongsTo （一对多关联的反转）
    public function category()
    {
        return $this->belongsTo(NewsCategory::class);
    }


}

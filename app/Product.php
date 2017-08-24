<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    //状态
    const STATUS_YES = 1;//启用状态
    const STATUS_NO = 2;//禁用状态

    public function statusAlias($returnAll = false)
    {

        $map = [
            self::STATUS_YES => '启用', //1 => '启用',
            self::STATUS_NO => '禁用',  //2 => '禁用',
        ];
        if ($returnAll) {
            return $map;
        }
        return array_key_exists($this->status, $map) ? $map[$this->status] : '';
    }

    //一个分类下，有多个商品，叫一对多关联hasMany  =》 反过来，就叫belongsTo （一对多关联的反转）
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function description()
    {
        return $this->hasOne(ProductDescription::class);
    }

}

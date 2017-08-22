<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    //状态
    const STATUS_YES = 1;//启用状态
    const STATUS_NO = 2;//禁用状态

    protected $fillable = ['name', 'sort', 'status', 'parent_id']; //置顶可填充的值

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

    public function getFullName()
    {
        if ($this->path == '0,') {
            return $this->name;
        }
        // $this->path   0,1,2,
        $path = substr($this->path, 2); //1,2,
        $path = rtrim($path, ','); //1,2
        $ids = explode(',', $path); //[1,2]
        $names = self::whereIn('id', $ids)->pluck('name')->toArray();//['电脑','电脑整机']
        return join(' > ', $names) . ' > ' . $this->name;
    }

}

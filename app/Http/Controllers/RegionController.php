<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\region;


class RegionController extends Controller
{
    /*
     * 通过父级地区的Id，返回该级别的下级地区
     */
    public function search(Request $retuest)
    {
        $parentId = $retuest->get('parent_id');

        $data = Region::where("parent_id",$parentId)->get();
        return $data;//json
    }

}

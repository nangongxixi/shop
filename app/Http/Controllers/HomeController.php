<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        //查询分类信息
        $categories = [];
        foreach (Category::all() as $category) {
            $categories[$category->parent_id][] = $category;
        }

        //dd($categories[0]);
        /*
        $categories[0]=[
            ['id'=>1,'name'=>'电脑']，
            ['id'=>3,'name'=>'服装']，
        ];
        */

        return view('home.index')->with('categories', $categories);

    }
}

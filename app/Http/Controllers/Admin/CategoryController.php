<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //分类列表
    public function index()
    {
        //所有的分类信息
        //分析，本项目分类信息，不会超过100条，所以不做分页
        $categories = Category::orderBy('sort')->get();
        return view('admin.category.index')->with('categories', $categories);
    }

    //新增分类
    public function create()
    {

        $category = new Category();

        //所有的分类
        $categories = Category::get();

        /*
        $category->status=1;
        $map = $category->statusAlias(true);
        dd($map);
        exit;
        */
        return view('admin.category.create')->with([
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    public function doCreate(Request $request)
    {
        $data = $request->all();
        $parentId = $request->get('parent_id');
        if ($parentId == 0) {
            $path = '0,';
        } else {
            //查用户选择的父级分类
            $parentCagegory = Category::find($parentId);
            if ($parentCagegory == null) {
                abort(500, '父级ID有误');
            }
            $path = $parentCagegory->path . ',' . $parentId . ',';
        }
        $data['path'] = $path;

        $category = new Category();
        //$category->name= $request->get('name');
        //dd($request->all());exit;
        $category->fill($data); //批量填充
        $category->path = $path; //安全起见，建议不采用填充的方式
        $category->save();
    }

}
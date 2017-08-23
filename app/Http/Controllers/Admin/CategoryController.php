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
        $categories = Category::orderByRaw('concat(path, id)')->get(); //orderBy会认为单引是一个列，而orderByRaw会认为单引是sql的一部分
        return view('admin.category.index')->with('categories', $categories);
    }

    //新增分类
    public function create()
    {

        $category = new Category();

        //所有的分类
        $categories = Category::orderByRaw('concat(path, id)')->get();

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
            $path = $parentCagegory->path . $parentId . ',';
        }
        $data['path'] = $path;

        $category = new Category();
        //$category->name= $request->get('name');
        //dd($request->all());exit;
        $category->fill($data); //批量填充
        $category->path = $path; //安全起见，建议不采用填充的方式

        if ($category->save()) {
            return redirect('admin/category');
        };

    }

    public function delete(Request $request)
    {
        //1,2,4 或者 4
        $ids = explode(",", $request->get('id'));

        //select * from category where id in (1,2,4)
        $categories = Category::whereIn('id', $ids)->get();

        //开启事务
        \DB::beginTransaction();

        $deleted = 0; //记录成功删除的数量
        foreach ($categories as $category) {
            if (!$category->allowDelete()) {
                break; //只要有一条没删除，就跳出循环
            }
            $deleted += $category->delete();
        }
        //判断是否全部删除成功
        if ($deleted == count($categories)) {
            //提交事务
            \DB::commit();
            $message = '删除成功了' . $deleted . '条记录';
        } else {
            //回滚事务
            \DB::rollBack();
            $message = '删除失败';
        }

        return redirect()->back()->with('message', $message); //是将这个消息放入的session中（一次性消息）

    }


}
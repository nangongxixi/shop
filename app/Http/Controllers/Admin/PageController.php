<?php

namespace App\Http\Controllers\Admin;

use App\page;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class PageController extends Controller
{

    public function index()
    {

        $page = new page();
        $pages = Page::orderBy("id", 'asc')->paginate();

        return view('admin.page.index')->with('pages', $pages);
    }

    //显示添加单页面的表单
    public function create(Request $request)
    {
        return view('admin.page.create');
    }

    //执行添加单页面
    public function store(Request $request)
    {
        $data = $request->all();
        $data["coverPic"] = (string)$data["coverPic"];
        $page = new page();
        $page->fill($data);

        if ($page->save()) {
            return ["status" => true, "message" => "添加成功"];
           // return redirect()->back()->with('message', "添加成功"); //是将这个消息放入的session中（一次性消息，和视图里面的session配套使用）
          // return back()->withInput()->with('message', '添加成功');
        }

    }

    //修改单页面
    public function update()
    {
    }

    //删除单页面
    public function delete()
    {
    }

}

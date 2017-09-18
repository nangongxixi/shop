<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProductPost;
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
    public function create()
    {
        return view('admin.page.create');
    }

    //修改单页面
    public function edit($id)
    {
        if ($id) {
            $page = Page::findOrFail($id);
            return view('admin.page.edit')->with('page', $page);
        }
    }

    //执行添加单页面
    public function store(Request $request)
    {
        $id = $request->get('id');
        $data = $request->all();
        $data["coverPic"] = (string)$data["coverPic"];

        //修改
        if ($id) {
            $page = Page::findOrFail($id);
            $page->fill($data);
            if ($page->save()) {
                return ["status" => true, "message" => "修改成功"];
            }
        //新增
        } else {
            $page = new page();
            $page->fill($data);
            if ($page->save()) {
                return ["status" => true, "message" => "添加成功"];
                // return redirect()->back()->with('message', "添加成功"); //是将这个消息放入的session中（一次性消息，和视图里面的session配套使用）
                //return back()->withInput()->with('message', '添加成功');
            }
        }


    }



    //删除页面
    public function destroy($id)
    {
        $ids = explode(",", $id);
        $pages = Page::whereIn("id", $ids)->get();

        \DB::beginTransaction();//开启事务

        $delete = 0;
        foreach ($pages as $page) {
            $delete += $page->delete();
        }

        if ($delete == count($pages)) {
            \DB::commit();
            $message = '成功删除了' . $delete . '条信息';
        } else {
            \DB::callback();
            $message = '删除失败！';
        }

        return redirect()->back()->with('message', $message);//带着你的消息滚回去
    }

}

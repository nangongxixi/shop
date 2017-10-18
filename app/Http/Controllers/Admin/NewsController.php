<?php

namespace App\Http\Controllers\Admin;

use App\News;
use App\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    //初始化加载列表
    public function index(Request $request)
    {

        //获取前端保存的cookie值
        $tagIndex = (int)$_COOKIE['tagIndex'];
        if(!$tagIndex){
            $tagIndex=0;
        }

        $condition = [];
        if($request->get('name')){
            $condition[] = ['name','like','%'.$request->get('name').'%'];
        }
        if($request->get('status') != null){
            $condition[] = ['status','=',$request->get('status')];
        }

        $newsList = News::orderBy('id','desc')
            ->where(["category_id" => $tagIndex, "delete_tag" => 1])
            ->where($condition)
            ->paginate(3);


        //todo 取得 列表  映射到views


        dd($newsList);

        return view('admin.news.index')->with('newsList', $newsList);
    }

    //添加的表单
    public function create()
    {
        $newsStatus = new News();
        $newsCategory = NewsCategory::get();
        return view('admin.news.create')->with([
            "newsCategory" => $newsCategory,
            "newsStatus" => $newsStatus,
        ]);
    }

    //修改的表单
    public function edit($id)
    {
        $newsStatus = new News();
        $newsInfo = News::findOrFail($id);
        $newsCategory = NewsCategory::get();
        return view('admin.news.edit')->with([
            "newsCategory" => $newsCategory,
            "newsInfo" => $newsInfo,
            'newsStatus'=>$newsStatus
        ]);
    }

    //执行添加、修改单页面
    public function store(Request $request)
    {
        $id = $request->get('id');
        $data = $request->all();
        $data["coverPic"] = (string)$data["coverPic"];
        $data["category_id"] = (integer)$data["category_id"];

        //修改
        if ($id) {

            $news = News::findOrFail($id);
            $news->fill($data);
            if ($news->save()) {
                return ["status" => true, "message" => "修改成功"];
            }
            //新增
        } else {
            $news = new news();
            $news->fill($data);
            if ($news->save()) {
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
        $newsList = News::whereIn("id", $ids)->get();

        \DB::beginTransaction();//开启事务

        $delete = 0;
        foreach ($newsList as $news) {
            $newsObj = News::findOrFail($news->id);
            $newsObj->delete_tag = 0; //修改删除的状态
            if ($newsObj->save()) {
                $delete += 1;
            }
        }

        if ($delete == count($newsList)) {
            \DB::commit();
            $message = '成功删除了' . $delete . '条信息';
        } else {
            \DB::callback();
            $message = '删除失败！';
        }

        return redirect()->back()->with('message', $message);//带着你的消息滚回去
    }


}

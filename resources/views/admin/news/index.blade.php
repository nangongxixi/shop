@extends('admin.layouts.master');

<?php $leftMenuActive = 'admin/news'; ?>

@section('content-wrapper')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                新闻管理
                <small>新闻列表</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('admin/news') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li class="active">新闻管理</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="col-xs-12">
                <form action="" method="get">
                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" value="{{ request()->get('name') }}" name="name"
                                           class="form-control" placeholder="新闻标题">
                                </div>
                                <div class="col-md-3">
                                    <select name="status" class="form-control">
                                        <option value="">全部状态</option>
                                        @foreach($newsList['hyNews'][0]->statusAlias(true) as $key=>$item)
                                            <option value="{{ $key }}"
                                                    @if(request()->get('status')!=null && request()->get('status') == $key) selected @endif>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <span class="glyphicon glyphicon-search"></span> 搜索
                                        </button>
                                        <a href="{{ url('admin/news') }}" type="submit"
                                           class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-repeat"></span> 全部
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @include('admin.common._message')

                <div class="box">
                    <div class="box-header">
                        <a href="{{ url('admin/news/create') }}" class="btn btn-primary btn-sm"><span
                                    class="glyphicon glyphicon-plus"></span> 新增</a>
                        <a href="javascript:;" class="js-delete btn btn-danger btn-sm"><span
                                    class="glyphicon glyphicon-trash"></span> 删除</a>
                        <form id="js-delete-form" action="" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                    </div>
                    <!-- 公司新闻 -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">公司新闻</a></li>
                            <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">行业新闻</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="activity">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <th><input type="checkbox" class="js-select-all"></th>
                                        <th>ID</th>
                                        <th>所属大类</th>
                                        <th>标题</th>
                                        <th>描述</th>
                                        <th>新增时间</th>
                                        <th>状态</th>
                                        <th>排序</th>
                                        <th>操作</th>
                                    </tr>
                                    @foreach($newsList as $page)
                                        <tr>
                                            <th><input type="checkbox" class="ids" value="{{ $page->id }}"></th>
                                            <td>{{ $page->id }}</td>
                                            <td>{{ $page->category->name }}</td>
                                            <td>{{ $page->name }}</td>
                                            <td title="{{ $page->description }}">{{ mb_strlen($page->description, 'utf-8') > 9 ? mb_substr($page->description, 0, 20, 'utf-8').'....' : $page->description }}</td>
                                            <td>{{ $page->created_at }}</td>
                                            <td>{{ $page->statusAlias() }}</td>
                                            <td>{{ $page->sort }}</td>
                                            <td>
                                                <a href="news/{{ $page->id }}/edit">编辑</a>
                                                <a data-id="{{ $page->id }}" class="js-delete-one"
                                                   href="javascript:;">删除</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="box-footer clearfix">
                                    {{ $newsList->links() }}
                                </div>
                            </div>

                            <!-- 行业新闻 -->
                            <div class="tab-pane" id="timeline">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <th><input type="checkbox" class="js-select-all"></th>
                                        <th>ID</th>
                                        <th>所属大类</th>
                                        <th>标题</th>
                                        <th>描述</th>
                                        <th>新增时间</th>
                                        <th>状态</th>
                                        <th>排序</th>
                                        <th>操作</th>
                                    </tr>
                                    @foreach($newsList as $page)
                                        <tr>
                                            <th><input type="checkbox" class="ids" value="{{ $page->id }}"></th>
                                            <td>{{ $page->id }}</td>
                                            <td>{{ $page->category->name }}</td>
                                            <td>{{ $page->name }}</td>
                                            <td title="{{ $page->description }}">{{ mb_strlen($page->description, 'utf-8') > 9 ? mb_substr($page->description, 0, 20, 'utf-8').'....' : $page->description }}</td>
                                            <td>{{ $page->created_at }}</td>
                                            <td>{{ $page->statusAlias() }}</td>
                                            <td>{{ $page->sort }}</td>
                                            <td>
                                                <a href="news/{{ $page->id }}/edit">编辑</a>
                                                <a data-id="{{ $page->id }}" class="js-delete-one"
                                                   href="javascript:;">删除</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="box-footer clearfix">
                                    {{ $newsList->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section("js")
    <script>

        init();

        //单条删除
        $(document).on("click", ".js-delete-one", function () {
            var id = $(this).attr("data-id");
            leaf.confirm("您确定要删除吗？", function () {
                $("#js-delete-form").attr("action", "news/" + id);
                //提交表单
                $("#js-delete-form").submit();
            });
        })

        //全选
        $(".js-select-all").click(function () {
            //去自己的状态
            var status = $(this).prop('checked');
            //将下面的checkbox置为选中状态或非选中状态
            $(this).parent().closest(".table").find(".ids").prop("checked", status);
        });

        //多条删除
        $(document).on("click", ".js-delete", function () {
            var ids = [];
            var idsArr = $(".ids:checked");
            for (var i = 0; i < idsArr.length; i++) {
                ids.push($(idsArr[i]).attr("value"));
            }
            if (ids.length == 0) {
                leaf.toast("请先选择您要删除的数据");
                return;
            }
            leaf.confirm("您确定要删除吗？", function () {
                $("#js-delete-form").attr("action", "news/" + ids.toString());
                //提交表单
                $("#js-delete-form").submit();
            });
        })


        function init(){
            //获取标签索引值，并修改相应的active
            var tagIndex = sessionStorage.getItem("tagIndex");
            if (tagIndex) {
                $(".nav-tabs li").eq(tagIndex).addClass('active').siblings().removeClass("active");
                $('.tab-content .tab-pane').eq(tagIndex).addClass('active').siblings().removeClass("active");
            }
            ;
            //点击标签，保存其索引值
            $(".nav-tabs li").click(function () {
                sessionStorage.setItem("tagIndex", $(this).index());
                document.cookie="tagIndex="+$(this).index();

            });
        }



    </script>

@endsection
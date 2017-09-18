@extends('admin.layouts.master');

<?php $leftMenuActive = 'admin/page'; ?>

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

                @include('admin.common._message')

                <div class="box">
                    <div class="box-header">
                        <a href="{{ url('admin/news/create') }}" class="btn btn-primary btn-sm"><span
                                    class="glyphicon glyphicon-plus"></span> 新增</a>
                        <a href="javascript:;" class="js-delete btn btn-danger btn-sm"><span
                                    class="glyphicon glyphicon-trash"></span> 删除</a>
                        <form id="js-delete-form" action="" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                        </form>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th><input type="checkbox" class="js-select-all"></th>
                                <th>ID</th>
                                <th>标题</th>
                                <th>描述</th>
                                <th>新增时间</th>
                                <th>操作</th>
                            </tr>

                            @foreach($newsList as $page)
                                <tr>
                                    <th><input type="checkbox" class="ids" value="{{ $page->id }}"></th>
                                    <td>{{ $page->id }}</td>
                                    <td>{{ $page->title }}</td>
                                    <td title="{{ $page->description }}">{{ mb_strlen($page->description, 'utf-8') > 9 ? mb_substr($page->description, 0, 20, 'utf-8').'....' : $page->description }}</td>
                                    <td>{{ $page->created_at }}</td>
                                    <td>
                                        <a href="page/{{ $page->id }}/edit">编辑</a>
                                        <a data-id="{{ $page->id }}" class="js-delete-one"
                                           href="javascript:;">删除</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

@endsection

@section("js")
    <script>

        //单条删除
        $(document).on("click", ".js-delete-one", function () {
            var id = $(this).attr("data-id");
            leaf.confirm("您确定要删除吗？", function () {
                // $("#js-delete-form").find("input").val(id);
                $("#js-delete-form").attr("action", "page/" + id);
                //提交表单
                $("#js-delete-form").submit();
            });
        })

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
                $("#js-delete-form").attr("action", "page/" + ids.toString());
                //提交表单
                $("#js-delete-form").submit();
            });

        })

    </script>

@endsection
@extends('admin.layouts.master');

<?php $leftMenuActive = 'admin/page'; ?>

@section('content-wrapper')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                单页管理
                <small>单页列表</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('admin/page') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li class="active">单页管理</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="col-xs-12">

                @include('admin.common._message')

                <div class="box">
                    <div class="box-header">
                        <a href="{{ url('admin/page/create') }}" class="btn btn-primary btn-sm"><span
                                    class="glyphicon glyphicon-plus"></span> 新增</a>
                        <a href="javascript:;" class="js-delete btn btn-danger btn-sm"><span
                                    class="glyphicon glyphicon-trash"></span> 删除</a>
                        <form id="js-delete-form" action="{{ url('admin/page/delete') }}" method="post"
                              style="display:none ">
                            {{ csrf_field() }}
                            <input type="text" name="id" value="">
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
                                <th>内容</th>
                                <th>新增时间</th>
                                <th>操作</th>
                            </tr>

                            @foreach($pages as $page)
                                <tr>
                                    <th><input type="checkbox" class="ids" value="{{ $page->id }}"></th>
                                    <td>{{ $page->id }}</td>
                                    <td>{{ $page->title }}</td>
                                    <td title="{{ $page->content }}">{{ mb_strlen($page->content, 'utf-8') > 9 ? mb_substr($page->content, 0, 20, 'utf-8').'....' : $page->content }}</td>
                                    <td>{{ $page->created_at }}</td>
                                    <td>
                                        <a href="{{ url('admin/page/update',$page->id) }}">编辑</a>
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
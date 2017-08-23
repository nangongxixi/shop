@extends('admin.layouts.master')
@section('content-wrapper')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                添加分类
                <small>填写分类信息</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li class="active"><a href="{{ url('admin/category') }}">分类管理</a></li>
                <li class="active">新增分类</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Success alert preview. This alert is dismissable.
            </div>

            <div class="box box-primary">
                <!-- form start -->
                <form role="form" action="" method="post">

                    {{ csrf_field() }}

                    <div class="box-body">
                        <div class="form-group">
                            <label>父级</label>
                            <select class="form-control" name="parent_id">
                                <option value="0">[ 顶级 ]</option>
                                @foreach($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->getFullName() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">名称</label>
                            <input type="text" name="name" class="form-control" id="" placeholder="">
                            <p class="help-block">请输入分类名称</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">排序</label>
                            <input type="text" name="sort" class="form-control" id=""
                                   placeholder="Password">
                            <p class="help-block">请输入整数，越小越靠前</p>
                        </div>
                        <div class="form-group">
                            <label>状态</label>
                            <div>
                                {{--
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="optionsRadios" id=""
                                                   value="{{ \App\Category::STATUS_YES }}" checked="">
                                            启用
                                        </label>
                                    </div>
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="optionsRadios" id=""
                                                   value="{{ \App\Category::STATUS_NO }}">
                                            禁用
                                        </label>
                                    </div>
                                --}}
                                @foreach($category->statusAlias(true) as $key => $item)
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="status" id=""
                                                   value="{{ $key }}">
                                            {{ $item }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </form>
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection
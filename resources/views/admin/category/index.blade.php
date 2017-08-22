@extends('admin.layouts.master');
@section('content-wrapper')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                商品列表
                <small>商品列表小细节</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="名称">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="单价">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="demo">
                            </div>
                            <div class="col-md-3">
                                <botton type="submit" class="btn btn-primary btn-sm">
                                    <span class="glyphicon glyphicon-search"></span> 搜索
                                </botton>
                                <a type="submit" class="btn btn-primary btn-sm">
                                    <span class="glyphicon glyphicon-repeat"></span> 全部
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Success alert preview. This alert is dismissable.
            </div>

            <div class="box">
                <div class="box-header">
                    <a href="{{ url('admin/category/create') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> 新增</a>
                    <a href="" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> 删除</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>ID</th>
                            <th>名称</th>
                            <th>状态</th>
                            <th>排序</th>
                            <th>新增时间</th>
                            <th>操作</th>
                        </tr>

                        @foreach($categories as $category)
                            <tr>
                                <th><input type="checkbox"></th>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->statusAlias() }}</td>
                                <td>{{ $category->sort }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>
                                    <a href="">编辑</a>
                                    <a href="">删除</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection
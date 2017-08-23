@extends('admin.layouts.master');
@section('content-wrapper')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                商品管理
                <small>商品列表</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('admin/product') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li class="active">商品列表</li>
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
                                           class="form-control" placeholder="分类名称">
                                </div>
                                <div class="col-md-3">
                                    <select name="status" class="form-control">
                                        <option value="">全部状态</option>
                                        <option value="{{ \App\Category::STATUS_YES }}"
                                                @if(request()->get('status')==\App\Category::STATUS_YES) selected @endif>
                                            启用
                                        </option>
                                        <option value="{{ \App\Category::STATUS_NO }}"
                                                @if(request()->get('status')==\App\Category::STATUS_NO) selected @endif>
                                            禁用
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <span class="glyphicon glyphicon-search"></span> 搜索
                                        </button>
                                        <a href="{{ url('admin/product') }}" type="submit"
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
                        <a href="{{ url('admin/product/create') }}" class="btn btn-primary btn-sm"><span
                                    class="glyphicon glyphicon-plus"></span> 新增</a>
                        <a href="javascript:;" class="js-delete btn btn-danger btn-sm"><span
                                    class="glyphicon glyphicon-trash"></span> 删除</a>
                        <form id="js-delete-form" action="{{ url('admin/product/delete') }}" method="post"
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
                                <th>名称</th>
                                <th>分类</th>
                                <th>状态</th>
                                <th>排序</th>
                                <th>新增时间</th>
                                <th>操作</th>
                            </tr>

                            @foreach($products as $product)
                                <tr>
                                    <th><input type="checkbox" class="ids" value="{{ $product->id }}"></th>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->statusAlias() }}</td>
                                    <td>{{ $product->sort }}</td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>
                                        <a href="{{ url('admin/product/update',$product->id) }}">编辑</a>
                                        <a data-id="{{ $product->id }}" class="js-delete-one"
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

@section('js')

    <script>
        $(function () {
            //删除单条
            $(".js-delete-one").click(function () {
                var id = $(this).attr("data-id");
                leaf.confirm("您确定要删除吗？", function () {
                    //console.log(id);
                    //把id填充到form表单中
                    $("#js-delete-form").find("input[name='id']").val(id);
                    //提交表单
                    $("#js-delete-form").submit();
                });
            });

            //多条删除
            $(".js-delete").click(function () {

                var ids = [];
                //取到已选中的项
                var checkboxList = $(".ids:checked");
                for (var i = 0; i < checkboxList.length; i++) {
                    ids.push($(checkboxList[i]).val());
                }
                if (ids.length == 0) {
                    leaf.toast("请先选择您要删除的数据");
                    return;
                }
                leaf.confirm("您确定要删除吗？", function () {
                    //把id填充到form表单中
                    $("#js-delete-form").find("input[name='id']").val(ids.toString());

                    //提交表单
                    $("#js-delete-form").submit();
                });

            });

            //全选
            $(".js-select-all").click(function () {
                //去自己的状态
                var status = $(this).prop('checked');
                //将下面的checkbox置为选中状态或非选中状态
                $(".ids").prop("checked", status);
            });
        });
    </script>


@endsection
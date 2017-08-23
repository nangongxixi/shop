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

            @if(session('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> {{ session('message') }}</h4>
                </div>
            @endif

            <div class="box">
                <div class="box-header">
                    <a href="{{ url('admin/category/create') }}" class="btn btn-primary btn-sm"><span
                                class="glyphicon glyphicon-plus"></span> 新增</a>
                    <a href="javascript:;" class="js-delete btn btn-danger btn-sm"><span
                                class="glyphicon glyphicon-trash"></span> 删除</a>
                    <form id="js-delete-form" action="{{ url('admin/category/delete') }}" method="post"
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
                            <th>状态</th>
                            <th>排序</th>
                            <th>新增时间</th>
                            <th>操作</th>
                        </tr>

                        @foreach($categories as $category)
                            <tr>
                                <th><input type="checkbox" class="ids" value="{{ $category->id }}"></th>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->getFullName() }}</td>
                                <td>{{ $category->statusAlias() }}</td>
                                <td>{{ $category->sort }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>
                                    <a href="">编辑</a>
                                    <a data-id="{{ $category->id }}" class="js-delete-one"
                                       href="javascript:;">删除</a>
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

@section('js')

    <script>
        $(function () {
            //删除单条
            $(".js-delete-one").click(function () {

                if(!confirm("您确定要删除吗？")){
                    return;
                }

                var id = $(this).attr("data-id");
                //console.log(id);
                //把id填充到form表单中
                $("#js-delete-form").find("input[name='id']").val(id);
                //提交表单
                $("#js-delete-form").submit();
            });

            //多条删除
            $(".js-delete").click(function () {

                var ids = [];
                //取到已选中的项
                var checkboxList = $(".ids:checked");
                for (var i = 0; i < checkboxList.length; i++) {
                    ids.push($(checkboxList[i]).val());
                }
                ;

                //把id填充到form表单中
                $("#js-delete-form").find("input[name='id']").val(ids.toString());

                //提交表单
                $("#js-delete-form").submit();

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
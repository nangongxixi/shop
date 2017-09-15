@extends('admin.layouts.master')

<?php $leftMenuActive = 'admin/page'; ?>

@section('content-wrapper')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                添加单页
                <small>填写单页信息</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li class="active"><a href="{{ url('page') }}">单页管理</a></li>
                <li class="active">新增单页</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            @include('admin.common._message')

            <div class="box box-primary">
                <!-- form start -->
                <form action="{{ url('admin/page') }}" method="post">

                    {{ csrf_field() }}

                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">标题</label>
                            <input type="text" name="title" class="form-control" id="" placeholder="">
                            <p class="help-block">请输入标题</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">内容</label>
                            <form>
                                <textarea id="nangongxixiEditor" name="content" rows="10" cols="80"></textarea>
                            </form>
                            <p class="help-block">请输入内容</p>
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" id="js-submit">提交</button>
                    </div>
                </form>
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <!-- CK Editor -->
    <script src="{{ asset('static/AdminLTE/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function () {
            var editor = CKEDITOR.replace('nangongxixiEditor');//实例化富文本编辑框
            $("#js-submit").click(function () {
                var title = $("input[name='title']").val();
                var content = editor.document.getBody().getHtml();//获取富文本编辑框的值
                var token = $("input[name='_token']").val();
                $.ajax({
                    url: "{{ url('admin/page') }}",
                    type: "POST",
                    data: {"title": title, "content": content,"coverPic":666, "_token":token},
                    dataType: "json",
                    success: function (res) {
                        if (res.status) {
                            leaf.toast(res.message,3000);
                            window.location="{{ url('admin/page') }}";
                        } else {
                            alert(res.message);
                        }
                    },
                    error: function () {
                        alert('网络出错了');
                    }
                });
            });
        });


    </script>
@endsection
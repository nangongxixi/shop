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
                <form action="" method="post">

                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $page->id }}">

                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">标题</label>
                            <input type="text" name="title" class="form-control" id="" placeholder="" value="{{ $page->title }}" >
                            <p class="help-block">请输入标题</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">描述</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="">{{ $page->description }}</textarea>
                            <p class="help-block">请输入描述</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">内容</label>
                            <form>
                                <textarea id="nangongxixiEditor" name="content" rows="10" cols="80">{{ $page->content }}</textarea>
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
                $("iframe").contents().find("body").html();
                var title = $.trim($("input[name='title']").val());
                var content = $.trim(editor.document.getBody().getHtml());//获取富文本编辑框的值
                var description =  $.trim($("textarea[name='description']").val());
                var token = $("input[name='_token']").val();
                var id = $("input[name='id']").val();

                if(title.length<1){
                    $("input[name='title']").parent().addClass("has-error");
                    return false;
                }
                if(content.length<1){
                    $("textarea[name='content']").parent().parent().addClass("has-error");
                    return false;
                }

                $.ajax({
                    url: "{{ url('admin/page') }}",
                    type: "POST",
                    data: {"title": title, "content": content, "coverPic": 666, "_token": token, "id":parseInt(id),"description":description},
                    dataType: "json",
                    success: function (res) {
                        if (res.status) {
                            leaf.toast(res.message, '',function(){
                                window.location = "{{ url('admin/page') }}";
                            });
                        } else {
                            leaf.toast(res.message);
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
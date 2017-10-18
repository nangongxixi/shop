@extends('admin.layouts.master')

<?php $leftMenuActive = 'admin/page'; ?>

@section('content-wrapper')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                编辑新闻
                <small>填写新闻信息</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li class="active"><a href="{{ url('page') }}">新闻管理</a></li>
                <li class="active">编辑新闻</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            @include('admin.common._message')

            <div class="box box-primary">
                <!-- form start -->
                <form action="" method="post">

                    {{ csrf_field() }}

                    <div class="box-body">
                        <div class="form-group">
                            <label>分类</label>
                            <select class="form-control" name="category_id">
                                @foreach($newsCategory as $item)
                                    <option value="{{ $item->id }}" @if($item->id == $newsInfo->category_id) selected @endif>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">标题</label>
                            <input type="text" name="name" class="form-control" id="" placeholder="" value="{{ $newsInfo->name }}">
                            <p class="help-block">请输入标题</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">描述</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="">{{ $newsInfo->description }}</textarea>
                            <p class="help-block">请输入描述</p>
                        </div>
                        <div class="form-group">
                            <label>状态</label>
                            <div>
                                @foreach($newsStatus->statusAlias(true) as $key => $item)
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="status" id=""
                                                   value="{{ $key }}" @if($key == $newsInfo->status) checked @endif>
                                            {{ $item }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">排序</label>
                            <input type="text" name="sort" class="form-control" id="inputSort"
                                   placeholder="" value="{{ $newsInfo->sort }}">
                            <p class="help-block">请输入整数，越小越靠前</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">内容</label>
                            <form>
                                <textarea id="nangongxixiEditor" name="content" rows="10" cols="80">{{ $newsInfo->content }}</textarea>
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

                $(document).find(".has-error").removeClass();
                var categoryId = $.trim($("select").val());
                var name = $.trim($("input[name='name']").val());
                var description = $.trim($("textarea[name='description']").val());
                var status = $("input[name='status']:checked").val();
                var sort = $("input[name='sort']").val();
                var content = $.trim(editor.document.getBody().getHtml());//获取富文本编辑框的值
                var id = "{{ $newsInfo->id }}";

                var token = $("input[name='_token']").val();

                if (name.length < 1) {
                    $("input[name='name']").parent().addClass("has-error");
                    return false;
                }

                if (description.length < 1) {
                    $("textarea[name='description']").parent().addClass("has-error");
                    return false;
                }

                if (typeof(status) == "undefined") {
                    $("input[name='status']").parent().closest(".form-group").addClass("has-error");
                    return false;
                }

                $.ajax({
                    url: "{{ url('admin/news') }}",
                    type: "POST",
                    data: {
                        "id":id,
                        "category_id": categoryId,
                        "name": name,
                        "status": status,
                        "content": content,
                        "coverPic": 666,
                        "sort":sort,
                        "_token": token,
                        "description": description
                    },
                    dataType: "json",
                    success: function (res) {
                        if (res.status) {
                            leaf.toast(res.message, '', function () {
                                window.location = "{{ url('admin/news') }}";
                            });

                        } else {
                            alert(res.message);
                        }
                    },
                    error: function () {
                        //alert('网络出错了');
                    }
                });
            });
        });


    </script>
@endsection
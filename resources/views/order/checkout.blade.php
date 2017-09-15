@extends("layouts.main");

@section("content")
    <form action="" id="my-form">
        <section id="checkout-page">
            <div class="container">
                <div class="col-xs-12 no-margin">

                    <div class="billing-address">
                        <h2 class="border h1">您的收货地址</h2>

                        <div class="row field-row">
                            <div class="col-xs-12 col-sm-6">
                                <label>收货人姓名*</label>
                                <input class="le-input" name="receiver_name">
                            </div>
                        </div><!-- /.field-row -->

                        <div class="row field-row">
                            <div class="col-xs-12 col-sm-6">
                                <label>手机*</label>
                                <input class="le-input" name="receiver_phone">
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <label>邮箱</label>
                                <input class="le-input" name="receiver_email">
                            </div>
                        </div><!-- /.field-row -->

                        <div class="row field-row">
                            <div class="col-xs-12 col-sm-4">
                                <label>省*</label>
                                <select class="le-input" name="receiver_province" id="province">
                                    <option value="">——请选择——</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <label>市*</label>
                                <select class="le-input" name="receiver_city" id="city">
                                    <option value="">——请选择——</option>
                                    <option value="1">1111</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <label>区*</label>
                                <select class="le-input" name="receiver_district" id="district">
                                    <option value="">——请选择——</option>
                                    <option value="1">1111</option>
                                </select>
                            </div>
                        </div><!-- /.field-row -->

                        <div class="row field-row">
                            <div class="col-xs-12 col-sm-12">
                                <label>详细地址*</label>
                                <input class="le-input" name="receiver_detail">
                            </div>
                        </div><!-- /.field-row -->


                    </div><!-- /.billing-address -->


                    <section id="your-order">
                        <h2 class="border h1">您的订单</h2>

                        @foreach($carts as $cart)
                            <div class="row no-margin order-item">
                                <div class="col-xs-12 col-sm-1 no-margin">
                                    <a href="#" class="qty">{{ $cart->qty }}</a>
                                </div>

                                <div class="col-xs-12 col-sm-9 ">
                                    <div class="title"><a href="#">{{ $cart->product_name }} </a></div>
                                    <div class="brand">品牌</div>
                                </div>

                                <div class="col-xs-12 col-sm-2 no-margin">
                                    <div class="price">￥{{ $cart->price }}</div>
                                </div>
                            </div><!-- /.order-item -->
                        @endforeach
                    </section><!-- /#your-order -->

                    <div id="total-area" class="row no-margin">
                        <div class="col-xs-12 col-lg-4 col-lg-offset-8 no-margin-right">
                            <div id="subtotal-holder">

                                <ul id="total-field" class="tabled-data inverse-bold ">
                                    <li>
                                        <label>订单总金额</label>
                                        <div class="value">￥XXXXX.00</div>
                                    </li>
                                </ul><!-- /.tabled-data -->

                            </div><!-- /#subtotal-holder -->
                        </div><!-- /.col -->
                    </div><!-- /#total-area -->

                    <div id="payment-method-options">

                        <div class="payment-method-option">
                            <input class="le-radio" type="radio" name="pay_type" value="1"><i class="fake-box"></i><i
                                    class="fake-box"></i>
                            <div class="radio-label bold ">在线支付</div>
                        </div><!-- /.payment-method-option -->

                        <div class="payment-method-option">
                            <input class="le-radio" type="radio" name="pay_type" value="2"><i class="fake-box"></i><i
                                    class="fake-box"></i>
                            <div class="radio-label bold ">货到付款</div>
                        </div><!-- /.payment-method-option -->

                    </div><!-- /#payment-method-options -->

                    <div class="place-order-button">
                        <button class="le-button big js-submit">提交订单</button>
                    </div><!-- /.place-order-button -->

                </div><!-- /.col -->
            </div><!-- /.container -->
        </section>
    </form>
@endsection

@section("js")
    <script>
        $(function () {
            $("#province").change(function () {
                var id = $(this).val();
                $.ajax({
                    url: "{{ url('region/search') }}",
                    type: "GET",
                    data: {"parent_id": id},
                    dataType: "json",
                    success: function (res) {
                        //清空二级和三级
                        $("#city option:gt(0)").remove();
                        $("#district option:gt(0)").remove();

                        //填充二级城市
                        $.each(res, function (index, item) {
                            $("#city").append('<option value="' + item.id + '">' + item.name + '</option>');
                        });
                    },
                    error: function () {
                        alert('网络出错了');
                    }
                });
            });

            $("#city").change(function () {
                var id = $(this).val();
                $.ajax({
                    url: "{{ url('region/search') }}",
                    type: "GET",
                    data: {"parent_id": id},
                    dataType: "json",
                    success: function (res) {
                        $("#district option:gt(0)").remove();
                        $.each(res, function (index, item) {
                            $("#district").append('<option value="' + item.id + '">' + item.name + '</option>');
                        });
                    },
                    error: function () {
                        alert('网络出错了');
                    }
                });
            });

            $(".js-submit").click(function () {
                //验证收货人信息是否完整

                //验证支付方式是否已选择

                var data = $("#my-form").serialize();
                $.ajax({
                    url: "{{ url('order/create') }}",
                    type: "POST",
                    data: data,
                    dataType: "json",
                    success: function (res) {
                        if(res.status){
                            alert(res.message);
                            window.location = "{{ url("order/success") }}";
                        }else{
                            alert(res.message);
                        }
                    },
                    error: function () {
                        alert('网络出错了');
                    }
                });
                return false;

            });


        });
    </script>
@endsection
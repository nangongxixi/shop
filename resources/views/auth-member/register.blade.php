@extends('layouts.main');
@section('content')
    <main id="authentication" class="inner-bottom-md">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <section class="section sign-in inner-right-xs">
                        <h2 class="bordered">登录</h2>
                        <p>第三方帐号快速登录</p>

                        <div class="social-auth-buttons">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn-block btn-lg btn btn-facebook"><i class="fa fa-qq"></i> 使用QQ登录
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn-block btn-lg btn btn-twitter"><i class="fa fa-wechat"></i> 使用微信登录
                                    </button>
                                </div>
                            </div>
                        </div>

                        <form role="form" method="post" action="{{ url('member/login') }}" class="login-form cf-style-1">
                            {{ csrf_field() }}
                            <div class="field-row">
                                <label>邮箱</label>
                                <input type="text" name="email" class="le-input">
                            </div><!-- /.field-row -->

                            <div class="field-row">
                                <label>密码</label>
                                <input type="password" name="password" class="le-input">
                            </div><!-- /.field-row -->

                            <div class="field-row clearfix">
                        	<span class="pull-left">
                        		<label class="content-color"><input type="checkbox"
                                                                    class="le-checbox auto-width inline"> <span
                                            class="bold">记住我</span></label>
                        	</span>
                                <span class="pull-right">
                        		<a href="#" class="content-color bold">忘记密码 ?</a>
                        	</span>
                            </div>

                            <div class="buttons-holder">
                                <button type="submit" class="le-button huge">登 录</button>
                            </div><!-- /.buttons-holder -->
                        </form><!-- /.cf-style-1 -->

                    </section><!-- /.sign-in -->
                </div><!-- /.col -->

                <div class="col-md-6">
                    <section class="section register inner-left-xs">
                        <h2 class="bordered">注册</h2>
                        <p>注册一个新的帐号</p>

                        <form role="form" method="post" action="{{ url('member/register') }}" class="register-form cf-style-1">
                            {{ csrf_field() }}
                            <div class="field-row">
                                <label>邮箱</label>
                                <input type="text" name="email" class="le-input">
                            </div><!-- /.field-row -->

                            <div class="field-row">
                                <label>密码</label>
                                <input type="password" name="password" class="le-input">
                            </div><!-- /.field-row -->

                            <div class="buttons-holder">
                                <button type="submit" class="le-button huge">注 册</button>
                            </div><!-- /.buttons-holder -->
                        </form>

                        <h2 class="semi-bold">Sign up today and you'll be able to :</h2>

                        <ul class="list-unstyled list-benefits">
                            <li><i class="fa fa-check primary-color"></i> Speed your way through the checkout</li>
                            <li><i class="fa fa-check primary-color"></i> Track your orders easily</li>
                            <li><i class="fa fa-check primary-color"></i> Keep a record of all your purchases</li>
                        </ul>

                    </section><!-- /.register -->

                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container -->
    </main>
@endsection

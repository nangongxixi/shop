@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style=" background-color: rgba(255,255,255,0.4) !important;
            margin-left: 37.5%;
            margin-top: 13%;
            -moz-box-shadow:0px 0px 5px #808080;
            -webkit-box-shadow:0px 0px 5px #808080;
            box-shadow:0px 0px 5px #808080;
            border-radius: 10px;
            width: 390px;
            color: aliceblue;
            box-shadow: 0px 0px 20px 0px #819e99;
            ">
                <div class="">
                    <div class="">
                        <h2>欢迎登录</h2>
                        <br/>
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} ">
                                <div class="input-group input-group-lg">
                                    <div class="input-group-btn">
                                        <span class="btn btn-warning dropdown-toggle id=" sizing-addon1"><i
                                                class="glyphicon glyphicon-user"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <input type="text" name="email" id="email" class="form-control"
                                           style="border:0px;background-color:rgba(255,255,255,0.5) !important"
                                           placeholder="请输入工号"
                                           value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} ">
                                <div class="input-group input-group-lg">
                                    <div class="input-group-btn">
                                        <span class="btn btn-warning dropdown-toggle id=" sizing-addon1"><i
                                                class="glyphicon glyphicon-user"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <input type="text" name="password" id="password" class="form-control"
                                           style="border:0px;background-color:rgba(255,255,255,0.5) !important"
                                           placeholder="请输入工号"
                                           value="{{ old('password') }}" required autofocus>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-block btn-success btn-lg">登录</button>
                            </div>
                        </form>
                        <div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


        <div class="container">
            <div class="row">

        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

        <div class="form-group">
            <div class="input-group input-group-lg">
                <div class="input-group-btn">
                    <span class="btn btn-warning dropdown-toggle id=" sizing-addon1"><i
                            class="glyphicon glyphicon-user"
                            aria-hidden="true"></i></span>
                </div>
                <input type="text" name="username" class="form-control"
                       style="border:0px;background-color:rgba(255,255,255,0.5) !important" placeholder="请输入工号">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group input-group-lg">
                <div class="input-group-btn">
                    <span class="btn btn-warning dropdown-toggle id=" sizing-addon1"><i
                            class="glyphicon glyphicon-lock"></i></span>
                </div>
                <input type="password" name="pwd" class="form-control"
                       style="border:0px;background-color:rgba(255,255,255,0.5) !important" placeholder="请输入密码">
            </div>
        </div>

        <br/>
        <button type="button" id="submit" class="btn btn-block btn-success btn-lg">登录</button>


        </form>

            </div></div>
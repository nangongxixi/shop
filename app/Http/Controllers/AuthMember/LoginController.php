<?php

namespace App\Http\Controllers\AuthMember;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 会员注册登录
 * @package App\Http\Controllers\AuthMember
 */
class LoginController extends Controller
{
    /*
    * 登录
    */
    public function login(Request $request)
    {
        //get请求，显示界面
        if ($request->isMethod('get')) {
            return view('auth-member.register');
        }

        //post 登录
        $data = $request->only('email','password');
        if(auth()->guard('member')->attempt($data)){
            //此处session第一个参数为指定值，第二个参数为默认跳转位置
            $requestUrl = session('returnUrl','/');
            return redirect($requestUrl);
        }


    }


    /*
     * 注册
     */
    public function register(Request $request)
    {

        //todo 做数据验证

        //其他请求方式 post
        $email = $request->get('email');
        $password = $request->get('password');

        $member = new Member();
        $member->email = $email;
        $member->password = bcrypt($password);
        $member->name = substr($email, 0, strpos($email,'@'));

        if ($member->save()) {
            //注册成功将该用户登录
            auth()->guard('member')->login($member);
            //此处session第一个参数为指定值，第二个参数为默认跳转位置
            $requestUrl = session('returnUrl','/');
            return redirect($requestUrl);
        }

    }

}

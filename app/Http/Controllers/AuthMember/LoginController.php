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
     * 注册
     */
    public function register(Request $request)
    {
        //get请求，显示界面
        if ($request->isMethod('get')) {
            return view('auth-member.register');
        }

        //todo 做数据验证

        //其他请求方式 post
        $email = $request->get('email');
        $password = $request->get('password');

        $member = new Member();
        $member->email = $email;
        $member->password = bcrypt($password);
        $member->name = substr($email, 0, strpos($email,'@'));



        if ($member->save()) {
            //将该用户登录
           // \Auth::check();
            return ['status' =>true, 'message'=>'注册成功'];
        }

    }

    /*
     * 登录
     */
    public function login()
    {
        return view('auth-member.login');
    }
}

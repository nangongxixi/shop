<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    //购物车首页
    public function index()
    {
        //todo 将当前登录的会员，所有购物车数据查询出来
        $browserTag = \Cookie::get('browser_tag');
        $carts = Cart::where('browser_tag', '=', $browserTag)->get();
        return view('cart.index')->with([
            'carts' => $carts,
        ]);
    }

    //将商品添加到购物车
    public function add(Request $request)
    {
        $productId = $request->get("product_id");
        $browserTag = \Cookie::get('browser_tag'); //浏览器标记
        if (auth()->guard('member')->check()) {
            //会员登录状态
            $memberId = auth()->guard('member')->id(); //会员id
            $where = 'product_id = ? and (browser_tag = ? or member_id = ?)';
            $params = [$productId, $browserTag, $memberId];
        } else {
            //会员非登录状态
            $memberId = 0;
            $where = 'product_id = ? and browser_tag = ?';
            $params = [$productId, $browserTag];
        }

        $cart = Cart::whereRaw($where, $params)->first();

        if ($cart == null) {
            $cart = new Cart();
        }

        $cart->product_id = $productId;
        //$cart->attribute = $request->get("attribute");
        $cart->member_id = $memberId;
        $cart->browser_tag = $browserTag;

        //数据验证(只能整数，最大数量的提示, 是否存在商品id)
        $qty = (int)$request->get("qty");
        $qty = max(1, $qty);
        $cart->qty = $qty + $cart->qty;

        if ($cart->qty > 100) {
            return json_encode(['status' => false, 'error' => '数量不能超过100个']);
        }

        //商品判断
        $product = Product::find($cart->product_id);
        if ($product == null) {
            return ['status' => false, 'error' => '指定的商品不存在'];
        }
        if ($product->status != Product::STATUS_YES) {
            return ['status' => false, 'error' => '该商品已下架'];
        }

        $cart->product_name = $product->name;
        $cart->price = $product->price;

        if ($cart->save()) {
            return ['status' => true, 'message' => '添加商品成功'];
        } else {
            return ['status' => false, 'error' => '系统错误, 添加失败'];
        }
    }


    //更新购物车中商品的数量
    public function update(Request $request)
    {

        $cartId = $request->get('cartId');
        $qty = $request->get('qty');

        $browserTag = \Cookie::get('browser_tag');//浏览器标记

        $cart = Cart::where([
            ['product_id', $cartId], ['browser_tag', $browserTag]
        ])->first();

        if (empty($cart)) {
            return ['status' => false,
                'error' => '数据有误'];
        }

        $cart->qty = $qty;
        if ($cart->save()) {
            return ['status' => true, 'message' => '操作成功'];
        } else {
            return ['status' => false,
                'error' => '操作失败'];
        }


    }

    //删除购物车中的商品
    public function remove()
    {

    }

    //当前购物车的信息
    public function info()
    {
        $data = [
            'count' => 0,
            'money' => '0.00',
        ];

        $browserTag = \Cookie::get('browser_tag'); //浏览器标记


        if (empty($browserTag)) {
            return $data;
        }

        $carts = Cart::where('browser_tag', $browserTag)->get();
        foreach ($carts as $cart) {
            $data['count'] += $cart->qty;
            $data['money'] += $cart->qty * $cart->price;
        }
        return $data;

    }


}


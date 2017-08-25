<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    //购物车首页
    public function index(){
        $carts = Cart::all();
        return view('cart.index')->with([
            'carts'=>$carts,
        ]);
    }

    //将商品添加到购物车
    public function add(Request $request)
    {
        $cart = new Cart();
        $cart->fill($request->all());

        $cart->member_id = 0; //会员id
        $cart->browser_tag = \Cookie::get('browser_tag'); //浏览器标记


        //数据验证(只能整数，最大数量的提示, 是否存在商品id)
        $cart->qty = (int)$cart->qty;
        $cart->qty = max(1, $cart->qty);

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
    public function update()
    {

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
            $data['money'] = $cart->qty * $cart->price;
        }
        return $data;

    }


}


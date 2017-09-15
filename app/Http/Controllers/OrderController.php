<?php

namespace App\Http\Controllers;

use App\order;
use App\order_detail;
use App\Product;
use Illuminate\Http\Request;
use App\region;
use App\cart;

class OrderController extends Controller
{
    public function checkout()
    {
        //获取省份信息
        $provinces = Region::where("parent_id", "1")->get();

        //购物车信息
        $memberId = auth()->guard("member")->id();
        $carts = Cart::where("member_id", $memberId)->get();

        return view("order.checkout")->with([
            'provinces' => $provinces,
            'carts' => $carts,
        ]);
    }

    public function create(Request $request)
    {
        //当前会员ID
        $memberId = auth()->guard('member')->id();
        //当前会员购物车中的数据
        $carts = Cart::where("member_id", $memberId)->get();
        if (count($carts) == 0) {
            return ["status" => false, "error" => "购物车中没有商品"];
        }

        //检查购物车中商品是否已下架
        //单价是否有变动
        //库存是否足够
        //事务处理 目前是3张表操作

        //用户表单提交的售后人信息等数据
        $data = $request->all();//$data是一个数组
        $data['receiver_email'] = (string)$data['receiver_email'];

        //1.保存order表
        $order = new order();
        $order->fill($data);

        $order->member_id = $memberId;
        $order->name = $carts[0]->product_name . "等" . count($carts) . "件商品";
        $order->total_fee = self::getOrderTotalFee($carts);

        $order->save();

        //$order->status = '0';
        //$order->payment_status = '0';
        //$order->delivery_status = '0';

        //2.取购物车中的数据，存在order_detail表
        foreach ($carts as $cart) {
            $orderDetail = new order_detail();
            $orderDetail->product_id = $cart->product_id;
            $orderDetail->quantity = $cart->qty;
            $orderDetail->price = $cart->price;

            $orderDetail->product_full_name = self::getProductFullName($cart->product_id);
            $orderDetail->order_id = $order->id;

            $orderDetail->save();
        }

        //3.清空购物车
        Cart::where("member_id", $memberId)->delete();

        //根据结果返回相应的提示

        return ["status" => true, "message" => "下单成功"];

    }

    //获取商品完整名称
    protected function getProductFullName($productId)
    {
        //color size
        $product = Product::find($productId);
        return $product->name;
    }

    protected function getOrderTotalFee($carts)
    {
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->price * $cart->qty;
        }
        return $total;
    }

    public function success()
    {

    }


}

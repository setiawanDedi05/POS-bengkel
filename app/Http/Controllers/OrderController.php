<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index(){
        $orders = \App\Models\Order::with('user')->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.orders.index', compact('orders'));
    }

    public function show($idOrder){
        $order = \App\Models\Order::with('user')->findOrFail($idOrder);
        $orderItems = \App\Models\OrderItem::with('product')->where('id_order', $idOrder)->paginate(10);
        return view('pages.orders.detail', compact('order', 'orderItems'));
    }
}

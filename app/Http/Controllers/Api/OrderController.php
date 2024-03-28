<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class OrderController extends Controller
{
    //store order and order item
    public function store(Request $request)
    {
        //validate
        $request->validate([
            'transaction_time' => 'required',
            'id_cashier' => 'required|exists:users,id',
            'total_price' => 'required|numeric',
            'total_qty' => 'required|numeric',
            'service_fee' => 'required|numeric',
            'order_name' => 'required',
            'payment_method' => 'required|in:cash,qris',
            'order_items' => 'required|array',
            'order_items.*.id_product' => 'required|exists:products,id',
            'order_items.*.quantity' => 'required|numeric',
            'order_items.*.total_price' => 'required|numeric',
        ]);

        //create order
        $order = \App\Models\Order::create([
            'transaction_time' => $request->transaction_time,
            'id_cashier' => $request->id_cashier,
            'total_price' => $request->total_price,
            'total_qty' => $request->total_qty,
            'total_item' => $request->total_item,
            'service_fee' => $request->service_fee,
            'order_name' => $request->order_name,
            'payment_method' => $request->payment_method,
        ]);

        //create order item
        foreach ($request->order_items as $item) {
            \App\Models\OrderItem::create([
                'id_order' => $order->id,
                'id_product' => $item['id_product'],
                'quantity' => $item['quantity'],
                'total_price' => $item['total_price'],
            ]);
            $product = \App\Models\Product::where('id', $item['id_product'])->decrement('stock', $item["quantity"]);
        }

        if($request->payment_method == 'qris'){
            $this->sendNotification($request->id_cashier, "Pembayaran QRIS dengan total : Rp. ". number_format((string)$request->total_price, 0, ",", ".") ." berhasil");
        }

        //response
        return response()->json([
            'success' => true,
            'message' => 'Order Created'
        ], 201);
    }

    public function sendNotification($userId, $message) {
        $user = User::find($userId);
        $token = $user->fcm_id;

        $messaging = app('firebase.messaging');
        $notification = Notification::create('Pada Jaya Motor', $message);

        $message = CloudMessage::withTarget('token', $token)->withNotification($notification);

        $messaging->send($message);
    }
}

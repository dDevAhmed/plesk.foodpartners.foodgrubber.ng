<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\NewOrdersCollection;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\V1\NewOrdersResource;

class OrderController extends Controller
{
    public function newOrdersCount(){
        $ordersCount = Order::where('store_id', Auth::user()->userstore->id)
            ->where('order_status', 'placed')
            ->count();

            return response()->json([
                'status' => 200,
                'ordersCount' => $ordersCount
            ]);
    }
    
    public function newOrders(){
        $newOrders = Order::where('order_status', 'placed')
        ->where('store_id', Auth::user()->userstore->id)
        ->get();

        return new NewOrdersCollection($newOrders);
    }

    public function acceptOrder(Request $request, Order $order)
    {
        $order->update(['order_status' => 'processing']);
        // return redirect()->route('orders.index'); 

        return response()->json([
            'status' => 200,
            'message' => 'order accepted'
        ]);
    }

    public function orders(){
        $orders = Order::where('order_status', 'delivered')
        ->where('store_id', Auth::user()->userstore->id)
        ->get();

        return new NewOrdersCollection($orders);
    }
}

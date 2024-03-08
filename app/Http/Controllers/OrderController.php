<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;

class OrderController extends BaseController
{
    public function index()
    {
        $newOrders = Order::where('order_status', 'placed')
            ->where('store_id', Auth::user()->userstore->id)
            ->get();

        $deliveredOrders = Order::where('order_status', 'delivered')
            ->where('store_id', Auth::user()->userstore->id)
            ->get();

        // Loop through each order to fetch its corresponding items
        foreach ($newOrders as $newOrder) {
            $newOrder->items = $newOrder->orderItem()->get();
        }

        foreach ($deliveredOrders as $deliveredOrder) {
            $deliveredOrder->items = $deliveredOrder->orderItem()->get();
        }

        $pageTitle = 'Orders';
        $userStoreCheck = $this->checkUserStore();
        $newOrdersCount = $userStoreCheck['newOrdersCount'];

        return view('orders', compact(
            'pageTitle',
            'userStoreCheck',
            'newOrders',
            'newOrdersCount',
            'deliveredOrders'
        ));
    }

    public function acceptOrder(Request $request, Order $order)
    {
        $order->update(['order_status' => 'processing']);
        return redirect()->route('orders.index'); 
    }
}

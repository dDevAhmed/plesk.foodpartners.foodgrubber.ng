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

        // $orders = Order::all();

        $pageTitle = 'Orders';  // Set the page title for this view
        $userStoreCheck = $this->checkUserStore();
        $newOrdersCount = $userStoreCheck['newOrdersCount'];
        return view('orders', compact('pageTitle', 'userStoreCheck', 'newOrders', 'newOrdersCount', 'deliveredOrders'));
    }
}

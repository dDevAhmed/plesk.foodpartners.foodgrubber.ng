<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;

class OrderController extends BaseController
{

    //     // Assuming you have models for Order, Product, and User
    //      $orders = Order::whereHas('products', function ($query) {
    //     // Retrieve the auth user's store ID
    //     $storeId = Auth::user()->store->id;

    //     // Filter products belonging to the auth user's store
    //     $query->where('store_id', $storeId);
    //      })->get();

    //      // Access the orders and related product information
    //      foreach ($orders as $order) {
    //          foreach ($order->products as $product) {
    //         // Access order details, product details, etc.
    //          }
    //      }

    public function index()
    {
        // $orders = Order::with('products.store')->whereHas('products', function ($query) {
        //     $storeId = Auth::user()->store->id;
        //     $query->where('store_id', $storeId);
        // })->get();

        // fixme - get total numbers of orders for this store

        $pageTitle = 'Orders';  // Set the page title for this view
        $userStoreCheck = $this->checkUserStore();
        return view('orders', compact('pageTitle', 'userStoreCheck'));
    }
}

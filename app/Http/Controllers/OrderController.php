<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;

class OrderController extends BaseController
{

    public function order()
    {
        if (!Auth::check()) {
            // Redirect to login or display a message
            return response()->json([
                'status' => 400,
                'message' => 'Please log in to view your cart.'      
            ]);
        }

        $cart = Auth::user()->cart()->with('cartItems')->first();

        if (!$cart) {
            // Handle empty cart scenario
            // (e.g., display message or redirect to storefront)
            return response()->json([
                'status' => 400,
                'message' => 'You don\'t have products in cart, add products first.'      
            ]);
        }

        $cartItems = $cart->cartItems;
        $cartCount = $cart->quantity;
        $cartTotalPrice = $cart->total;
        
        return response()->json([
            'status' => 200,
            'cartTotalPrice' => $cartTotalPrice,
            'cartCount' => $cartCount,
            'cartItems' => $cartItems        
        ]);
    }


    // public function orderCount()
    // {
    //     if (Auth::check()) {
    //         $cart = Auth::user()->cart;
    //         $count = $cart ? $cart->quantity : 0;
    //         // return response()->json(['count' => $count]);
    //         return $count;
    //     } else {
    //         // return response()->json(['count' => 0]); // Or redirect to login if needed
    //         return 0;
    //     }
    // }

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

    public function cart()
    {
        $order = Auth::user()->cart()->with('cartItems')->first();

        if (!$cart) {
            // Handle empty cart scenario
            // (e.g., display message or redirect to storefront)
            return response()->json([
                'status' => 400,
                'message' => 'You don\'t have products in cart, add products first.'      
            ]);
        }

        $cartItems = $cart->cartItems;
        $cartCount = $cart->quantity;
        $cartTotalPrice = $cart->total;
    }

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

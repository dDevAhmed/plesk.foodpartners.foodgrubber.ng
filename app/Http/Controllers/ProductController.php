<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function add(Request $request)
    {
        $user = Auth::user(); // Get the currently authenticated user

        if (!$user->userstore) {
            return back()->with('fail', "You must set up your store before adding products.");
        }

        $product = new Product([
            // 'store_id' => get user store id,
            'name' => $request->productName,
            'price' => $request->productPrice,
            'cuisine' => $request->productCuisine,
            'category' => $request->productCategory,
            'description' => $request->productDescription,
            'measurement' => $request->productDescription,
        ]);

        if ($request->hasFile('image1')) {
            $imageName = time() . '_1.' . $request->image1->getClientOriginalExtension();
            $request->image1->move(public_path('img/products'), $imageName);
            $product->image1 = $imageName;
        }

        if ($request->hasFile('image2')) {
            $imageName = time() . '_2.' . $request->image2->getClientOriginalExtension();
            $request->image2->move(public_path('img/products'), $imageName);
            $product->image2 = $imageName;
        }

        if ($user->userstore) {
            $user->userstore->product()->save($product);
        } else {
            return back()->with('fail', "You must set up your store before adding products.");
        }
        // $product->save();

        return back()->with('success', "Product Added successfully");
    }

    public function deactivate($id)
    {
        $product = Product::find($id);
        $product->active = 0;
        $product->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json(['success' => true]);
    }
}

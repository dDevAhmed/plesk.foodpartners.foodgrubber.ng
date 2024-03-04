<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;

class ProductController extends BaseController
{
    public function index()
    {
        $pageTitle = 'Products';  // Set the page title for this view
        $userStoreCheck = $this->checkUserStore();
        $newOrdersCount = $userStoreCheck['newOrdersCount'];
        $categories = ProductCategory::pluck('category');
        $products = Auth::user()->product()->paginate(20);
        return view('products', compact('pageTitle', 'userStoreCheck', 'categories', 'products', 'newOrdersCount'));
    }

    public function add(Request $request)
    {
        $product = new Product([
            'store_id' => Auth::user()->userstore->id,
            'name' => $request->name,
            'price' => $request->price,
            'cuisine' => $request->cuisine,
            'category' => $request->category,
            'description' => $request->description,
            'measurement' => $request->measurement,
        ]);

        // fixme - store image as binary
        // if ($request->hasFile('image1')) {
        //     $image1Name = time() . '_1.' . $request->image1->getClientOriginalExtension();
        //     $request->image1->move(public_path('img/products'), $image1Name);
        //     $product->image1 = $image1Name;
        // }

        // if ($request->hasFile('image1')) {
        //     $imagePath1 = $request->image1->store(public_path('img/products')); // Store image temporarily
        //     $image1Contents = file_get_contents($imagePath1);
        //     $encodedImage1 = base64_encode($image1Contents);
        //     unlink($imagePath1); // Remove temporary file
        //     $product->image1 = $encodedImage1;
        // }

        if ($request->hasFile('image1')) {
            $image1File = $request->file('image1');
            $encodedImage1 = base64_encode(file_get_contents($image1File->getRealPath()));
            $product->image1 = $encodedImage1;
        }

        if ($request->hasFile('image2')) {
            $image2Name = time() . '_2.' . $request->image2->getClientOriginalExtension();
            $request->image2->move(public_path('img/products'), $image2Name);
            $product->image2 = $image2Name;
        }

        $product->save();

        return back()->with([
            'type' => 'success',
            'message' => "Product Added successfully"
        ]);

        // return back()->with('success', "Product Added successfully");
    }

    // Edit Logic (product.edit route)
    public function editProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
            // ... other validation rules
        ]);

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        // ... other attributes
        $product->save();

        return redirect()->route('products')->with('success', 'Product updated successfully!');
    }

    // public function deactivate($id)
    // {
    //     $product = Product::find($id);
    //     $product->active = 0;
    //     $product->save();

    //     return response()->json(['success' => true]);
    // }

    // public function destroy($id)
    // {
    //     $product = Product::find($id);
    //     $product->delete();

    //     return response()->json(['success' => true]);
    // }
}

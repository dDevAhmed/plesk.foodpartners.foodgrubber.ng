<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\V1\ProductResource;
use App\Http\Resources\V1\ProductCollection;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ProductCollection(Product::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // Add validation rules for all fields
            'name' => 'required|string',
            'price' => 'required|numeric',
            'cuisine' => 'required|string',
            'category' => 'required|string',
            'description' => 'required|string',
            'measurement' => 'required|string',
            'image1' => 'nullable|image',  // Example image validation
            'image2' => 'nullable|image',  // Example image validation
            // 'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $product = new Product($validatedData);

            // Handle image uploads with more robust filename generation
            if ($request->hasFile('image1')) {
                $image1Name = uniqid() . '.' . $request->image1->getClientOriginalExtension();
                $request->image1->move(public_path('img/products'), $image1Name);
                $product->image1 = asset('img/products/' . $image1Name);  // Store absolute URL
            }

            if ($request->hasFile('image2')) {
                $image2Name = uniqid() . '.' . $request->image2->getClientOriginalExtension();
                $request->image2->move(public_path('img/products'), $image2Name);
                $product->image2 = asset('img/products/' . $image2Name);  // Store absolute URL
            }

            // 'store_id' => Auth::user()->userstore->id,
            $product->store_id = Auth::user()->userstore->id;

            $product->save();

            return response()->json([
                'status' => 201,
                'message' => 'Product added successfully.'
            ]);
        } catch (\Exception $e) {
            // Handle errors gracefully
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        if($product){
            return new ProductResource($product);
        }else{
            return response()->json([
                
                'status' => 404,
                'message' => 'Product not found'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'string',
            'price' => 'numeric',
            'cuisine' => 'string',
            'category' => 'string',
            'description' => 'string',
            'measurement' => 'string',
            'image1' => 'nullable|image',  // Example image validation
            'image2' => 'nullable|image',  // Example image validation
            // 'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $product = Product::find($id);  // Retrieve existing product

            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }

            // Update product fields with validated data
            $product->fill($validatedData);

            // Handle image uploads (similar to store function)
            if ($request->hasFile('image1')) {
                $image1Name = uniqid() . '.' . $request->image1->getClientOriginalExtension();
                $request->image1->move(public_path('img/products'), $image1Name);
                $product->image1 = asset('img/products/' . $image1Name);  // Store absolute URL
            }
            
            if ($request->hasFile('image2')) {
                $image2Name = uniqid() . '.' . $request->image2->getClientOriginalExtension();
                $request->image2->move(public_path('img/products'), $image2Name);
                $product->image2 = asset('img/products/' . $image2Name);  // Store absolute URL
            }

            if ($product->store_id !== Auth::user()->userstore->id) {
                return response()->json(['error' => 'Unauthorized to update this product'], 403);
            }   
            
            $product->store_id = Auth::user()->userstore->id;

            $product->save();

            return response()->json([
                'status' => 200,
                'message' => 'Product updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        try {
            $product->delete();
            return response()->json([], 204);  // Use 204 No Content for successful deletion
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);  // Handle errors
        }
    }
}

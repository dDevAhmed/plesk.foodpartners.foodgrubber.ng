<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Bunny\Storage\Client;
use Bunny\Storage\Region;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;

class ProductController extends BaseController
{
    // private $bunnyClient;

    // public function __construct(Client $bunnyClient)
    // {
    //     $this->bunnyClient = $bunnyClient;
    // }

    public function index()
    {
        $pageTitle = 'Products';  // Set the page title for this view
        $userStoreCheck = $this->checkUserStore();
        $newOrdersCount = $userStoreCheck['newOrdersCount'];
        $categories = ProductCategory::pluck('category');
        $products = Auth::user()->product()->paginate(20);
        return view('products', compact('pageTitle', 'userStoreCheck', 'categories', 'products', 'newOrdersCount'));
    }

    // public function add(Request $request)
    // {
    //     $client = new Client('bfad6a1b-862d-4eac-b31c7c71e48b-46fa-43e2', 'foodgrubbergreen', \Bunny\Storage\Region::FALKENSTEIN);

    //     $product = new Product([
    //         'store_id' => Auth::user()->userstore->id,
    //         'name' => $request->name,
    //         'price' => $request->price,
    //         'cuisine' => $request->cuisine,
    //         'category' => $request->category,
    //         'description' => $request->description,
    //         'measurement' => $request->measurement,
    //     ]);

    //     // $this->uploadImages($request);
    //     // $this->uploadImages($request, $product);

    //     // if ($request->hasFile('image1')) {
    //     //     $image1Name = time() . '_1.' . $request->image1->getClientOriginalExtension();

    //     //     $client->upload('/path/to/local/file.txt', 'remote/path/hello-world.txt');

    //     //     $request->image1->move(public_path('img/products'), $image1Name);
    //     //     $product->image1 = $image1Name;
    //     // }

    //     if ($request->hasFile('image1')) {
    //         $fileName = $this->generateUniqueFilename($request->image1->getClientOriginalExtension());
    //         $client->upload($request->image1->getRealPath(), 'images/products' . $fileName); // Use getRealPath for local file path
    //         $product->image1 = $fileName;
    //     }


    //     // if ($request->hasFile('image2')) {
    //     //     $image2Name = time() . '_2.' . $request->image2->getClientOriginalExtension();
    //     //     $request->image2->move(public_path('img/products'), $image2Name);
    //     //     $product->image2 = $image2Name;
    //     // }

    //     $product->save();

    //     return back()->with([
    //         'type' => 'success',
    //         'message' => "Product Added successfully"
    //     ]);

    //     // return back()->with('success', "Product Added successfully");
    // }

    public function add(Request $request)
    {
        // Retrieve credentials from .env
        $apiAccessKey = config('services.bunnynetcdn.api_access_key');
        $storageZoneName = config('services.bunnynetcdn.storage_zone_name');
        $storageZoneRegion = config('services.bunnynetcdn.storage_zone_region');

        // Create the BunnyNet CDN client
        $client = new Client($apiAccessKey, $storageZoneName, \Bunny\Storage\Region::LONDON);

        // $client = new Client('bfad6a1b-862d-4eac-b31c7c71e48b-46fa-43e2', 'foodgrubbergreen', \Bunny\Storage\Region::LONDON);

        $product = new Product([
            'store_id' => Auth::user()->userstore->id,
            'name' => $request->name,
            'price' => $request->price,
            'cuisine' => $request->cuisine,
            'category' => $request->category,
            'description' => $request->description,
            'measurement' => $request->measurement,
        ]);

        if ($request->hasFile('image1')) {
            // Get the file extension
            $extension = $request->image1->getClientOriginalExtension();

            // Generate a unique filename
            $imageName = time() . '_1.' . $extension;

            // Upload the file to Bunnynet CDN
            $client->upload($request->file('image1')->getRealPath(), 'images/products/' . $imageName);

            // Construct the CDN URL manually
            $cdnUrl = 'https://foodgrubbergreen.b-cdn.net/images/products/' . $imageName;

            // Set the product image URL to the CDN URL
            $product->image1 = $cdnUrl;
        }

        $product->save();

        return back()->with([
            'type' => 'success',
            'message' => 'Product added successfully'
        ]);
    }


    private function uploadImages(Request $request, Product $product)
    {
        if ($request->hasFile('image1')) {
            $fileName = $this->generateUniqueFilename($request->image1->getClientOriginalExtension());
            $this->bunnyClient->upload($request->image1->getRealPath(), 'path/to/product/images/' . $fileName); // Use getRealPath for local file path
            $product->image1 = $fileName;
        }

        if ($request->hasFile('image2')) {
            $fileName = $this->generateUniqueFilename($request->image2->getClientOriginalExtension());
            $this->bunnyClient->upload($request->image2->getRealPath(), 'path/to/product/images/' . $fileName);
            $product->image2 = $fileName;
        }
    }

    private function generateUniqueFilename($extension)
    {
        return time() . '.' . $extension;
    }

    // Edit Logic (product.edit route)
    public function update(Request $request, $id)
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

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;

class UserStoreController extends BaseController
{
    public function index()
    {
        $pageTitle = 'Store';  // Set the page title for this view
        $userStoreCheck = $this->checkUserStore();
        $newOrdersCount = $userStoreCheck['newOrdersCount'];
        return view('store', compact('pageTitle', 'userStoreCheck', 'newOrdersCount'));
    }

    public function updateStore(Request $request)
    {
        $user = auth()->user();

        // Handle logo file upload
        // if ($request->hasFile('logo')) {
        //     $logoPath = $request->file('logo')->store('logos'); // Or your preferred storage path
        //     $request->merge(['logo' => $logoPath]);
        // }

        if ($request->hasFile('food_cert')) {
            $storeName = $request->input('name'); // Assuming store name is available in the request
            $foodCert = Str::slug($storeName) .'-' .time() . '.' . $request->food_cert->getClientOriginalExtension();
            $request->food_cert->move(public_path('img/foodCertificates'), $foodCert);
        }

        // for logo and cover???
        // if ($request->hasFile('food_cert')) {
        //     $storeName = $request->input('name'); // Assuming store name is available in the request
        //     $foodCert = Str::slug($storeName) .'-' .time() . '.' . $request->food_cert->getClientOriginalExtension();
        //     $request->food_cert->move(public_path('img/foodCertificates'), $foodCert);
        // }

        $user->userstore()->updateOrCreate(
            ['user_id' => $user->id], // column/value pairs to find
            [ // column/value pairs to update or create
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postcode' => $request->postcode,
                // 'current_location' => $request->current_location,    //fixme - get the current location
                'description' => $request->description,
                'food_cert_number' => $request->food_cert_number,
                'food_cert' => $foodCert,
                'account_number' => $request->account_number,
                'sort_code' => $request->sort_code,
                'bank' => $request->bank,
                // 'availability' => $request->availability,        //use toggle button
                'logo' => $request->logo,
                'cover_image' => $request->cover_image,
            ]
        );

        return back()->with('success', "Store Updated successfully");
    }

    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image',
        ]);

        // Get the uploaded image file
        $image = $request->file('logo');

        // Encode the image as base64
        $encodedImage = base64_encode(file_get_contents($image->getRealPath()));

        // Update the food partner model with the base64 image
        // $foodPartner = FoodPartner::find(/* your food partner ID here */); // Replace with your logic to fetch the food partner
        $foodPartner = Auth::user()->userstore();
        $foodPartner->update(['logo' => $encodedImage]);

        return back()->with('success', 'Logo updated successfully.');
    }


    // public function updateStoreAvailability(){
        // 'availability' => $request->availability,        //use toggle button
    // }
}

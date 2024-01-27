<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class UserStoreController extends BaseController
{
    public function index()
    {
        $pageTitle = 'Store';  // Set the page title for this view
        $userStoreCheck = $this->checkUserStore();
        return view('store', compact('pageTitle', 'userStoreCheck'));
    }

    public function update(Request $request)
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

    public function updateStoreAvailability(){
        // 'availability' => $request->availability,        //use toggle button
    }
}

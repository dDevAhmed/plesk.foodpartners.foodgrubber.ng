<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserStoreController extends BaseController
{
    public function index()
    {
        $userStoreUpdated = $this->checkUserStoreUpdated();
        return view('store', compact('userStoreUpdated'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $store = $user->userstore()->updateOrCreate(
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
                'food_cert' => $request->food_cert,
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
}

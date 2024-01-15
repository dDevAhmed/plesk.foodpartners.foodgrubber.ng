<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\V1\UserStoreResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserStore;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class StoreController extends Controller
{
    public function store()
    {
        $userStore = Auth::user()->userstore;
        $response = [
            'status' => 201,
            'store' => $userStore       //if store comes with info not needed, use resource file to filter
        ];

        return new UserStoreResource($userStore);
        // return response()->json($Response);
    }

    public function updateStore(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postcode' => 'string',
            'current_location' => 'string',
            'description' => 'required|string',
            'food_cert_number' => 'string',
            'food_cert' => 'string',
            'account_number' => 'string',
            'sort_code' => 'string',
            'bank' => 'string',
            'availability' => 'string',     //from the toggle button
        ]);

        Auth::user()->userstore()->updateOrCreate([
            'user_id' => Auth::user()->id,
            'name' => $fields['name'],
            'phone' => $fields['phone'],
            'address' => $fields['address'],
            'city' => $fields['city'],
            'state' => $fields['state'],
            'postcode' => $fields['postcode'],
            'current_location' => $fields['current_location'],
            'description' => $fields['description'],
            'food_cert_number' => $fields['food_cert_number'],
            'food_cert' => $fields['food_cert'],
            'account_number' => $fields['account_number'],
            'sort_code' => $fields['sort_code'],
            'bank' => $fields['bank'],
            'availability' => $fields['availability'],
        ]);

        $response = [
            'status' => 201,
            'Message' => 'Store updated successfully.'
        ];

        return response()->json($response);
    }
}

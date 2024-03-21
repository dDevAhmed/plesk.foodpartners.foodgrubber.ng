<?php

namespace App\Http\Controllers;

use Bunny\Storage\Client;
use Bunny\Storage\Region;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;

class UserStoreController extends BaseController
{
    public $apiAccessKey;
    public $storageZoneName;
    public $storageZoneRegion;
    public $client;

    // Retrieve credentials from .env
    // public $apiAccessKey = config('services.bunnynetcdn.api_access_key');
    // public $storageZoneName = config('services.bunnynetcdn.storage_zone_name');
    // public $storageZoneRegion = config('services.bunnynetcdn.storage_zone_region');

    // // Create the BunnyNet CDN client
    // public $client = new Client($apiAccessKey, $storageZoneName, \Bunny\Storage\Region::LONDON);

    public function __construct()
    {
        $this->apiAccessKey = config('services.bunnynetcdn.api_access_key');
        $this->storageZoneName = config('services.bunnynetcdn.storage_zone_name');
        $this->storageZoneRegion = config('services.bunnynetcdn.storage_zone_region');

        // Create the BunnyNet CDN client
        $this->client = new Client($this->apiAccessKey, $this->storageZoneName, \Bunny\Storage\Region::LONDON);  //\Bunny\Storage\Region::LONDON
    }

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

        if ($request->hasFile('food_cert')) {
            $storeName = $request->input('name'); // Assuming store name is available in the request
            $foodCert = Str::slug($storeName) . '-' . time() . '.' . $request->food_cert->getClientOriginalExtension();
            $request->food_cert->move(public_path('img/foodCertificates'), $foodCert);
        }

        if ($request->hasFile('food_cert')) {
            // Get the file extension
            $extension = $request->food_cert->getClientOriginalExtension();

            // Generate a unique filename
            $foodCertName = time() . '_1.' . $extension;

            // Upload the file to Bunnynet CDN
            $this->client->upload($request->file('food_cert')->getRealPath(), 'documents/foodcertificates/' . $foodCertName);

            // Construct the CDN URL
            $cdnUrl = 'https://foodgrubbergreen.b-cdn.net/documents/foodcertificates/' . $foodCertName;

            // Update the food certificate URL in the database
            $foodPartner = Auth::user()->userstore;
            $foodPartner->food_cert = $cdnUrl;
            $foodPartner->save();
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
        if ($request->hasFile('logo')) {
            // Get the file extension
            $extension = $request->logo->getClientOriginalExtension();

            // Generate a unique filename
            $logoName = time() . '_1.' . $extension;

            // Upload the file to Bunnynet CDN
            $this->client->upload($request->file('logo')->getRealPath(), 'images/logos/' . $logoName);

            // Construct the CDN URL
            $cdnUrl = 'https://foodgrubbergreen.b-cdn.net/images/logos/' . $logoName;

            // Update the logo URL in the database
            $foodPartner = Auth::user()->userstore;
            $foodPartner->logo = $cdnUrl;
            $foodPartner->save();
        }

        return back()->with('success', 'Logo updated successfully.');
    }

    // public function updateStoreAvailability(){
    // 'availability' => $request->availability,        //use toggle button
    // }
}

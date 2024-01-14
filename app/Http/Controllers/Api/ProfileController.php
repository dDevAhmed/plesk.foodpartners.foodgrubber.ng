<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class UserProfileController extends Controller
{
    // public function profile(Request $request){
    //     $someData = [
    //         'name' => 'Ahmed',
    //         'status' => 'coding'
    //     ];

    //     return $someData;
    // }
    public function index()
    {
        // $user = User::where('email', $fields['email'])->first();
        // if (!$user || !Hash::check($fields['password'], $user->password)) {
        //     return response()->json([
        //         'status' => 401,
        //         'message' => 'Bad Credentials'
        //     ]);
        // }

        // $Response = [
        //     'status' => 201,
        //     'user' => $user,
        //     // 'token' => $token,
        // ];
        return response()->json();
        // return Auth::user();
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $user->update([
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            // 'currentlocation' => $request->currentlocation,
            'state' => $request->state,
            'country' => $request->country,
            'postcode' => $request->postcode,
        ]);
        return response()->json([
            'user' => $user,
            'Message' => 'user details updated successfully'
        ]);
    }
    public function avatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image',
        ]);

        $avatarName = time() . '.' . $request->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('avatars'), $avatarName);

        Auth::user()->update(['avatar' => $avatarName]);
        return response()->json([
            'avatar' => url('/avatars/' . Auth::user()->avatar),
            'Message' => 'Avatar Updated Successfully'
        ]);
    }
    public function getavatar()
    {
        return response()->json([
            'avatar' => url('/avatars/' . Auth::user()->avatar)
        ]);
    }
    
}

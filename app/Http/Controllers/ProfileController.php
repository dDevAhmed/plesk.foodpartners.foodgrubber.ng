<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends BaseController
{

    public function index()
    {
        $pageTitle = 'Profile';  // Set the page title for this view
        $userStoreCheck = $this->checkUserStore();
        return view('profile', compact('pageTitle', 'userStoreCheck'));
    }

    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'max:255',
            'state' => 'max:255',
            'country' => 'max:255',
            'postcode' => 'max:6',
        ]);

        // Fill user attributes
        $user = $request->user();
        foreach ($validatedData as $key => $value) {
            $user->$key = $value;
        }

        // Save user
        $user->save();

        // Return success message without redirection
        return back()->with('status', 'Profile updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatarInput' => 'required|image',
        ]);

        $avatarName = time() . '.' . $request->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('img/avatars'), $avatarName);

        Auth()->user()->update(['avatar' => $avatarName]);

        return back()->with('success', 'Avatar updated successfully.');
    }
}

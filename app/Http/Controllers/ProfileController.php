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
        $userStoreUpdated = $this->checkUserStoreUpdated();
        return view('profile', compact('userStoreUpdated'));
    }

    public function update(Request $request)
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


    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
}

<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

// fixme - implement mustverifyemail
class AppController extends BaseController
{
    // display dashboard
    public function index()
    {
        // $user = Auth::user(); // Get the currently authenticated user

        $userStoreCheck = $this->checkUserStore();
        return view('dashboard', $userStoreCheck);

        // if ($user && $user->hasVerifiedEmail() && $user->active == 1) {
        //     return view('dashboard');
        // }


        // if ($user->userstore) {
        //     $userStoreUpdated = true;

        //     // return back()->with('fail', "You must set up your store before adding products.");
        //     return view('dashboard', [
        //         'userStoreUpdated' => $userStoreUpdated,
        //     ]);
        // } else {
        //     $userStoreUpdated = false;

        //     return view('dashboard', [
        //         'userStoreUpdated' => $userStoreUpdated,
        //     ]);
        // }

        // Redirect to a different page if the user is not logged in, not verified, or status is not 1
        // return redirect('welcome')->with(
        //     'message', 
        //     '<i class="fa fa-check" style="font-size:48px; color: #01c324;"></i> <br> Registration and verification successful. <br> A notification will be sent to you when the admin activates your account.'
        // );

    }
}

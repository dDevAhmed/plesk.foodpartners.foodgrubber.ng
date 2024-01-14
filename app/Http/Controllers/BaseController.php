<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    protected function checkUserStoreUpdated()
    {
        $user = Auth::user();

        // Check for both existence of UserStore and active status
        $userStoreUpdated = $user->userstore && $user->userstore->status === 'a';
    
        return $userStoreUpdated;
    }
}

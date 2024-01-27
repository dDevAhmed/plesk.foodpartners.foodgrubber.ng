<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    protected function checkUserStore()
    {
        $user = Auth::user();

        // Check for both existence of UserStore and active status
        $noUserStore = !$user->userstore;
        $userStoreCreatedPending = $user->userstore && $user->userstore->status === 'p';
        $userStoreCreatedAccepted = $user->userstore && $user->userstore->status === 'a';
        $userStoreAcceptedAway = $user->userstore && $user->userstore->status === 'a' && $user->userstore->availability === false;
        // Collect variables for views:
        $viewData = [
            'noUserStore' => $noUserStore,
            'userStoreCreatedPending' => $userStoreCreatedPending,
            'userStoreCreatedAccepted' => $userStoreCreatedAccepted,
            'userStoreAcceptedAway' => $userStoreAcceptedAway,
            // Add more variables as needed
        ];

        return $viewData;
    }
}

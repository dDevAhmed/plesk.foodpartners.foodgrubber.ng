<?php

namespace App\Http\Controllers;

use App\Models\Order;
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

        $userstore = Auth::user()->userstore;
        if ($userstore) {
            $newOrdersCount = Order::where('store_id', $userstore->id)
                ->where('order_status', 'placed')
                ->count();
        } else {
            // Handle the case where there's no associated store (e.g., return 0)
            $newOrdersCount = 0;
        }

        // Collect variables for views:
        $viewData = [
            'noUserStore' => $noUserStore,
            'userStoreCreatedPending' => $userStoreCreatedPending,
            'userStoreCreatedAccepted' => $userStoreCreatedAccepted,
            'userStoreAcceptedAway' => $userStoreAcceptedAway,

            'newOrdersCount' => $newOrdersCount,
            // Add more variables as needed
        ];

        return $viewData;
    }
}

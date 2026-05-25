<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | SAVED SERVICES
        |--------------------------------------------------------------------------
        */

        $savedServices = $user
            ->savedServices()
            ->with([
                'provider:id,user_id,name,slug,avatar',
            ])
            ->latest()
            ->limit(3)
            ->get();

        $totalSaved = $user
            ->savedServices()
            ->count();

        $newSaved = $savedServices->count();

        /*
        |--------------------------------------------------------------------------
        | TEMPORARY STATS
        |--------------------------------------------------------------------------
        | Order system belum selesai
        */

        $totalOrders = 0;

        $activeOrders = 0;

        $newOrders = 0;

        /*
        |--------------------------------------------------------------------------
        | PLACEHOLDER COLLECTIONS
        |--------------------------------------------------------------------------
        | Agar dashboard tidak error
        */

        $recentOrders = collect();

        $recentlyViewed = collect();

        $notifications = collect();

        return view(
            'pages.dashboard.index',
            compact(
                'user',
                'savedServices',
                'totalSaved',
                'newSaved',
                'totalOrders',
                'activeOrders',
                'newOrders',
                'recentOrders',
                'recentlyViewed',
                'notifications'
            )
        );
    }
}

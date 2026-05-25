<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Service::query()
            ->where('status', 'published')
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->limit(8)
            ->pluck('category');

        $popularServices = Service::query()
            ->with([
                'provider:id,user_id,name,slug,avatar',
            ])
            ->where('status', 'published')
            ->orderByDesc('rating')
            ->latest()
            ->limit(8)
            ->get();

        $recommendedServices = Service::query()
            ->with([
                'provider:id,user_id,name,slug,avatar',
            ])
            ->where('status', 'published')
            ->inRandomOrder()
            ->limit(8)
            ->get();

        $savedServiceIds = [];

        if (Auth::check()) {

            /** @var \App\Models\User $user */
            $user = Auth::user();

            $savedServiceIds = $user
                ->savedServices()
                ->pluck('services.id')
                ->toArray();

        }

        return view(
            'pages.home',
            compact(
                'categories',
                'popularServices',
                'recommendedServices',
                'savedServiceIds'
            )
        );
    }
}

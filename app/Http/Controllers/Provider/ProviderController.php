<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index(Request $request)
    {

        $providers = collect([
            [
                'id' => 1,
                'name' => 'Bunda Sari',
                'avatar' => 'https://randomuser.me/api/portraits/women/44.jpg',
                'rating' => 5,
                'reviews' => 342,
                'category' => 'Les Privat',
                'price' => 50000,
                'orders' => 1250,
                'location' => 'Jakarta Selatan',
                'desc' => 'Guru matematika berpengalaman',
                'badge' => 'Top Rated',
                'is_top' => true,
                'is_new' => false,
                'is_active' => true,
            ],
            [
                'id' => 2,
                'name' => 'Creative Studio',
                'avatar' => 'https://randomuser.me/api/portraits/men/52.jpg',
                'rating' => 4.9,
                'reviews' => 228,
                'category' => 'Desain',
                'price' => 200000,
                'orders' => 890,
                'location' => 'Online',
                'desc' => 'Desain logo profesional',
                'badge' => 'Baru',
                'is_top' => true,
                'is_new' => true,
                'is_active' => false,
            ],
        ]);

        if ($request->q) {
            $providers = $providers->filter(
                fn($p) =>
                str_contains(strtolower($p['name']), strtolower($request->q)) ||
                str_contains(strtolower($p['category']), strtolower($request->q))
            );
        }

        if ($request->category) {
            $providers = $providers->where('category', $request->category);
        }

        if ($request->rating) {
            $providers = $providers->where('rating', '>=', $request->rating);
        }

        // SPLIT SECTION
        $topProviders = $providers->where('is_top', true);
        $newProviders = $providers->where('is_new', true);
        $activeProviders = $providers->where('is_active', true);
        $allProviders = $providers->sortByDesc('rating');

        return view('pages.providers.index', compact(
            'topProviders',
            'newProviders',
            'activeProviders',
            'allProviders'
        ));

    }
}

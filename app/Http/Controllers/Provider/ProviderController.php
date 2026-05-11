<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Provider;
use App\Models\Service;

class ProviderController extends Controller
{
    public function index(Request $request)
    {
        $query = Provider::with([
            'services'
        ])->where(
            'is_active',
            true
        );

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'name',
                    'like',
                    "%{$search}%"
                )->orWhere(
                    'bio',
                    'like',
                    "%{$search}%"
                )->orWhere(
                    'category',
                    'like',
                    "%{$search}%"
                )->orWhere(
                    'location',
                    'like',
                    "%{$search}%"
                );

            });

        }

        // Category filter
        if ($request->filled('category')) {

            $query->where(
                'category',
                $request->category
            );

        }

        // Location filter
        if ($request->filled('location')) {

            $query->where(
                'location',
                $request->location
            );

        }

        // Get providers
        $providers = $query
            ->latest()
            ->get()
            ->map(function ($provider) {

                $publishedServices = $provider->services
                    ->where('status', 'published');

                $provider->services_count = $publishedServices
                    ->count();

                $provider->total_orders = $publishedServices
                    ->sum('total_orders');

                $provider->average_rating = round(
                    $publishedServices->avg('rating') ?? 0,
                    1
                );

                $provider->total_reviews = $publishedServices
                    ->sum('total_orders');

                return $provider;

            });

        // Rating filter
        if ($request->filled('rating')) {

            $providers = $providers->filter(function ($provider) use ($request) {

                return $provider->average_rating >= (float) $request->rating;

            });

        }

        // Sorting
        switch ($request->get('sort')) {

            case 'orders':

                $providers = $providers
                    ->sortByDesc('total_orders');

                break;

            case 'new':

                $providers = $providers
                    ->sortByDesc('created_at');

                break;

            case 'active':

                $providers = $providers
                    ->sortByDesc('updated_at');

                break;

            case 'rating':
            default:

                $providers = $providers
                    ->sortByDesc('average_rating')
                    ->sortByDesc('total_orders');

                break;

        }

        // Top providers
        $topProviders = $providers
            ->sortByDesc('average_rating')
            ->sortByDesc('total_orders')
            ->take(4);

        // New providers
        $newProviders = $providers
            ->sortByDesc('created_at')
            ->take(5);

        // Active providers
        $activeProviders = $providers
            ->sortByDesc('updated_at')
            ->take(6);

        // Manual pagination
        $page = request()->get('page', 1);

        $perPage = 12;

        $paginatedProviders = new LengthAwarePaginator(
            $providers->forPage($page, $perPage),
            $providers->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        // Categories
        $categories = Provider::where(
            'is_active',
            true
        )->select(
            'category'
        )->distinct()->pluck(
            'category'
        );

        // Locations
        $locations = Provider::where(
            'is_active',
            true
        )->select(
            'location'
        )->distinct()->pluck(
            'location'
        );

        // Global stats
        $totalProviders = $providers->count();

        $averageRating = round(
            $providers->avg('average_rating') ?? 0,
            1
        );

        return view(
            'pages.providers.index',
            [
                'providers' => $paginatedProviders,
                'topProviders' => $topProviders,
                'newProviders' => $newProviders,
                'activeProviders' => $activeProviders,
                'categories' => $categories,
                'locations' => $locations,
                'totalProviders' => $totalProviders,
                'averageRating' => $averageRating,
            ]
        );
    }

    public function show($slug)
    {
        $provider = Provider::with([
            'services'
        ])->where(
            'slug',
            $slug
        )->where(
            'is_active',
            true
        )->firstOrFail();

        // Published services only
        $services = $provider->services
            ->where('status', 'published');

        // Metrics
        $totalServices = $services->count();

        $totalOrders = $services
            ->sum('total_orders');

        $averageRating = round(
            $services->avg('rating') ?? 0,
            1
        );

        $totalReviews = $totalOrders;

        // Featured service
        $featuredService = $services
            ->sortByDesc('total_orders')
            ->first();

        // Portfolio images
        $portfolioImages = $services
            ->pluck('image')
            ->filter()
            ->take(8);

        // Related providers
        $relatedProviders = Provider::with([
            'services'
        ])->where(
            'id',
            '!=',
            $provider->id
        )->where(
            'category',
            $provider->category
        )->where(
            'is_active',
            true
        )->take(4)
        ->get()
        ->map(function ($item) {

            $publishedServices = $item->services
                ->where('status', 'published');

            $item->services_count = $publishedServices
                ->count();

            $item->total_orders = $publishedServices
                ->sum('total_orders');

            $item->average_rating = round(
                $publishedServices->avg('rating') ?? 0,
                1
            );

            return $item;

        });

        // Temporary reviews
        $reviews = collect([]);

        return view(
            'pages.providers.show',
            compact(
                'provider',
                'services',
                'totalServices',
                'totalOrders',
                'averageRating',
                'totalReviews',
                'featuredService',
                'portfolioImages',
                'relatedProviders',
                'reviews'
            )
        );
    }

    public function create()
    {
        $user = Auth::user();

        if (!$user) {

            return redirect('/login');

        }

        if (
            Provider::where(
                'user_id',
                $user->id
            )->exists()
        ) {

            return redirect('/dashboard');

        }

        return view('pages.providers.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {

            return redirect('/login');

        }

        if (
            Provider::where(
                'user_id',
                $user->id
            )->exists()
        ) {

            return redirect('/dashboard');

        }

        $request->validate([
            'name' => 'required|min:3|max:255',
            'bio' => 'required|min:20',
            'category' => 'required',
            'location' => 'required',
            'type' => 'required|in:online,offline',
        ]);

        Provider::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'slug' => Str::slug(
                $request->name . '-' . uniqid()
            ),
            'bio' => $request->bio,
            'location' => $request->location,
            'category' => $request->category,
            'type' => $request->type,
            'verification_status' => 'pending',
            'is_active' => true,
        ]);

        User::where(
            'id',
            $user->id
        )->update([
            'role' => 1
        ]);

        return redirect('/dashboard')
            ->with(
                'success',
                'Berhasil menjadi penyedia! Lengkapi profil Anda atau tambahkan jasa.'
            );
    }
}

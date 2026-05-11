<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::with('provider')
            ->where('status', 'published');

        // Search filter
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'title',
                    'like',
                    "%{$search}%"
                )->orWhere(
                        'description',
                        'like',
                        "%{$search}%"
                    );

            });
        }

        // Multiple category filter
        if ($request->filled('category')) {

            $query->whereIn(
                'category',
                $request->category
            );
        }

        // Rating filter
        if ($request->filled('rating')) {

            $query->where(
                'rating',
                '>=',
                (float) $request->rating
            );
        }

        // Minimum price filter
        if ($request->filled('min_price')) {

            $query->where(
                'price',
                '>=',
                (int) $request->min_price
            );
        }

        // Maximum price filter
        if ($request->filled('max_price')) {

            $query->where(
                'price',
                '<=',
                (int) $request->max_price
            );
        }

        // Sorting
        switch ($request->get('sort')) {

            case 'price_low':
                $query->orderBy('price', 'asc');
                break;

            case 'price_high':
                $query->orderBy('price', 'desc');
                break;

            case 'rating':
                $query->orderBy('rating', 'desc');
                break;

            default:
                $query->latest();
                break;
        }

        // Pagination
        $services = $query
            ->paginate(12)
            ->withQueryString();

        // Categories
        $categories = Service::where('status', 'published')
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view(
            'pages.catalog.index',
            compact(
                'services',
                'categories'
            )
        );
    }

    public function show($slug)
    {
        $service = Service::with('provider')
            ->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        // Recommended services
        $recommended = Service::with('provider')
            ->where('status', 'published')
            ->where('category', $service->category)
            ->where('id', '!=', $service->slug)
            ->limit(4)
            ->get();

        return view(
            'pages.catalog.show',
            compact(
                'service',
                'recommended'
            )
        );
    }

}

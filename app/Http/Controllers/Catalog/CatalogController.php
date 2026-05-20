<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query()
            ->with([
                'provider:id,user_id,name,slug,avatar',
            ])
            ->where('status', 'published');

        // SEARCH
        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                // SERVICE TITLE
                $q->where(
                    'title',
                    'like',
                    "%{$search}%"
                )

                // SERVICE DESCRIPTION
                ->orWhere(
                    'description',
                    'like',
                    "%{$search}%"
                )

                // CATEGORY
                ->orWhere(
                    'category',
                    'like',
                    "%{$search}%"
                )

                // PROVIDER NAME
                ->orWhereHas('provider', function ($provider) use ($search) {

                    $provider->where(
                        'name',
                        'like',
                        "%{$search}%"
                    );

                });

            });

        }

        // CATEGORY FILTER
        if ($request->filled('category')) {

            $query->whereIn(
                'category',
                $request->category
            );

        }

        // RATING FILTER
        if ($request->filled('rating')) {

            $query->where(
                'rating',
                '>=',
                (float) $request->rating
            );

        }

        // MIN PRICE
        if ($request->filled('min_price')) {

            $query->where(
                'price',
                '>=',
                (int) $request->min_price
            );

        }

        // MAX PRICE
        if ($request->filled('max_price')) {

            $query->where(
                'price',
                '<=',
                (int) $request->max_price
            );

        }

        // SORTING
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

                // SEARCH PRIORITY
                if ($request->filled('search')) {

                    $query
                        ->orderByDesc('rating')
                        ->latest();

                } else {

                    $query->latest();

                }

                break;
        }

        // PAGINATION
        $services = $query
            ->paginate(12)
            ->withQueryString();

        // CATEGORIES
        $categories = Service::query()
            ->where('status', 'published')
            ->select('category')
            ->distinct()
            ->orderBy('category')
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
        $service = Service::query()
            ->with([
                'provider:id,user_id,name,slug,avatar',
            ])
            ->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        // RECOMMENDED SERVICES
        $recommended = Service::query()
            ->with([
                'provider:id,user_id,name,slug,avatar',
            ])
            ->where('status', 'published')
            ->where('category', $service->category)
            ->where('id', '!=', $service->id)
            ->orderByDesc('rating')
            ->latest()
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

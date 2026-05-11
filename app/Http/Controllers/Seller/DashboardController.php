<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // ambil provider milik user login
        $provider = Provider::where(
            'user_id',
            Auth::id()
        )->first();

        // default collection kosong
        $services = collect();

        // kalau provider ada
        if ($provider) {

            // ambil semua jasa milik seller
            $services = Service::where(
                'provider_id',
                $provider->id
            )
                ->latest()
                ->get();
        }

        // kirim ke view
        return view(
            'seller-pages.dashboard',
            compact(
                'provider',
                'services'
            )
        );
    }
}

<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('provider')->latest()->get();

        return view('pages.catalog.index', compact('services'));
    }

    public function create()
    {
        $user = Auth::user();

        // cek provider
        if (!$user->provider) {
            return redirect('/become-provider')
                ->with('error', 'Lengkapi profil penyedia dulu');
        }

        return view('pages.services.create');
    }
}

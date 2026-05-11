<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class HomeController extends Controller
{
    public function index() {
        $services = Service::with('provider')->where('status', 'published')->latest()->take(8)->get();

        return view('pages.home', compact('services'));
    }
}

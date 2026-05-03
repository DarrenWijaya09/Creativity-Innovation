<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\syaratKetentuan\SyaratController;
use App\Http\Controllers\Catalog\CatalogController;
use App\Http\Controllers\Provider\ProviderController;

Route::get('/', function () {
    return view('pages.home');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->middleware('rolemanager:customer')->name('dashboard');

    Route::get('/admin/dashboard', function () {
        return view('admin');
    })->middleware('rolemanager:admin')->name('admin');

    Route::get('/seller/dashboard', function () {
        return view('seller');
    })->middleware('rolemanager:seller')->name('seller');

});

// Google Login
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

// Syarat
Route::get('/syarat-ketentuan', [SyaratController::class, 'index'])->name('syarat-ketentuan');

// Catalog
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

// Penyedia
Route::prefix('providers')->group(function () {
    Route::get('/', [ProviderController::class, 'index'])->name('providers.index');
    Route::get('/{id}', [ProviderController::class, 'show'])->name('providers.show');
});

// Tentang
Route::get('/about', function () {
    return view('pages.about.index');
})->name('about');

require __DIR__ . '/auth.php';

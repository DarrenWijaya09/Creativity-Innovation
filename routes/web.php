<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\syaratKetentuan\SyaratController;
use App\Http\Controllers\Catalog\CatalogController;
use App\Http\Controllers\Provider\ProviderController;
use App\Http\Controllers\Forum\ForumController;
use App\Http\Controllers\Dashboard\ProfileController as DashboardProfileController;
use App\Http\Controllers\Seller\ServiceController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\HomeController;
use App\Models\Service;
use App\Http\Controllers\Forum\ForumReplyController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Chat\ConversationController;
use App\Http\Controllers\Chat\MessageController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('pages.dashboard.index');
    })->middleware('rolemanager:customer')->name('dashboard');

    Route::get('/admin/dashboard', function () {
        return view('admin');
    })->middleware('rolemanager:admin')->name('admin');

    // Route::get('/seller/dashboard', function () {
    //     $services = Service::latest()->get();
    //     return view('seller-pages.dashboard', compact('services'));
    // })->middleware('rolemanager:seller')->name('seller');

});

Route::middleware(['auth', 'rolemanager:seller'])
    ->prefix('seller')
    ->group(function () {

        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        )->name('seller.dashboard');

    });

// Google Login
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

// Syarat
// Route::get('/syarat-ketentuan', [SyaratController::class, 'index'])->name('syarat-ketentuan');
Route::get('/who-we-are', function () {
    return view('syarat-ketentuan.profile');
})->name('who-we-are');

// Syarat & Ketentuan (sudah ada biasanya, tapi pastikan)
Route::get('/syarat-ketentuan', function () {
    return view('syarat-ketentuan.hak');
})->name('syarat-ketentuan');

// Ruang Edukasi
Route::get('/ruang-edukasi', function () {
    return view('syarat-ketentuan.edukasi');
})->name('ruang-edukasi');

// Catalog
Route::get('/catalog', [CatalogController::class, 'index'])
    ->name('catalog.index');
Route::get('/catalog/{slug}', [CatalogController::class, 'show'])
    ->name('catalog.show');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

// Penyedia
Route::prefix('providers')->group(function () {

    Route::get('/', [ProviderController::class, 'index'])
        ->name('providers.index');

    Route::get('/{slug}', [ProviderController::class, 'show'])
        ->name('providers.show');

});

Route::middleware('auth')->group(function () {

    Route::get('/become-provider', [ProviderController::class, 'create'])
        ->name('provider.create');

    Route::post('/become-provider', [ProviderController::class, 'store'])
        ->name('provider.store');

});

// Tentang
Route::get('/about', function () {
    return view('pages.about.index');
})->name('about');

// Forum
Route::prefix('forum')->group(function () {

    Route::get('/', [ForumController::class, 'index'])
        ->name('forum.index');

    Route::middleware('auth')->group(function () {

        // THREAD

        Route::get('/create', [ForumController::class, 'create'])
            ->name('forum.create');

        Route::post('/store', [ForumController::class, 'store'])
            ->name('forum.store');

        Route::put('/{slug}', [ForumController::class, 'update'])
            ->name('forum.update');

        Route::delete('/{slug}', [ForumController::class, 'destroy'])
            ->name('forum.destroy');

        // REPLIES

        Route::post(
            '/{slug}/reply',
            [ForumReplyController::class, 'store']
        )->name('forum.reply.store');

        Route::put(
            '/reply/{reply}',
            [ForumReplyController::class, 'update']
        )->name('forum.reply.update');

        Route::delete(
            '/reply/{reply}',
            [ForumReplyController::class, 'destroy']
        )->name('forum.reply.destroy');

    });

    // SHOW HARUS PALING BAWAH
    Route::get('/{slug}', [ForumController::class, 'show'])
        ->name('forum.show');

});

// Contact
// Route::get('/contact', function () {
//     return view('pages.contact.index');
// })->name('contact');

// Profile Dashboard
Route::middleware(['auth'])->prefix('dashboard')->group(function () {

    // PROFILE
    Route::prefix('profile')->group(function () {

        // halaman profile
        Route::get('/', [DashboardProfileController::class, 'index'])
            ->name('profile.index');

        // update profile
        Route::put('/update', [DashboardProfileController::class, 'update'])
            ->name('profile.update');

    });

});

// Contact
Route::prefix('contact')->group(function () {

    Route::get(
        '/',
        [ContactController::class, 'index']
    )->name('contact.index');

    Route::post(
        '/',
        [ContactController::class, 'store']
    )->name('contact.store');

});

// Seller - Service
Route::middleware(['auth'])
    ->prefix('seller')
    ->group(function () {

        Route::get('/services/create', [ServiceController::class, 'create'])
            ->name('services.create');

        Route::post('/services/store', [ServiceController::class, 'store'])
            ->name('services.store');

        Route::get(
            '/services/{id}/edit',
            [ServiceController::class, 'edit']
        )->name('services.edit');

        Route::put(
            '/services/{id}',
            [ServiceController::class, 'update']
        )->name('services.update');

        Route::delete(
            '/services/{id}',
            [ServiceController::class, 'destroy']
        )->name('services.destroy');

    });

// Cart
Route::middleware('auth')
    ->prefix('cart')
    ->group(function () {

        Route::get(
            '/',
            [CartController::class, 'index']
        )->name('cart.index');

        Route::post(
            '/{service}',
            [CartController::class, 'store']
        )->name('cart.store');

        Route::delete(
            '/item/{item}',
            [CartController::class, 'destroy']
        )->name('cart.destroy');

    });

Route::middleware('auth')
    ->prefix('chat')
    ->group(function () {

        Route::get(
            '/',
            [ConversationController::class, 'index']
        )->name('chat.index');

        Route::get(
            '/{conversation}',
            [ConversationController::class, 'show']
        )->name('chat.show');

        Route::post(
            '/start/{provider}',
            [ConversationController::class, 'store']
        )->name('chat.start');

        Route::post(
            '/{conversation}/message',
            [MessageController::class, 'store']
        )->name('chat.message.store');

    });

require __DIR__ . '/auth.php';

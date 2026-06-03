<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Catalog\CatalogController;
use App\Http\Controllers\Provider\ProviderController;
use App\Http\Controllers\Forum\ForumController;
use App\Http\Controllers\Forum\ForumReplyController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Chat\ConversationController;
use App\Http\Controllers\Chat\MessageController;
use App\Http\Controllers\Service\SavedServiceController;
use App\Http\Controllers\Seller\ServiceController;
use App\Http\Controllers\Seller\DashboardController as SellerDashboardController;
use App\Http\Controllers\Dashboard\ProfileController as DashboardProfileController;
use App\Http\Controllers\Dashboard\DashboardController as UserDashboardController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// Google Auth
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

// Static Pages
Route::view('/who-we-are', 'syarat-ketentuan.profile')
    ->name('who-we-are');

Route::view('/syarat-ketentuan', 'syarat-ketentuan.hak')
    ->name('syarat-ketentuan');

Route::view('/ruang-edukasi', 'syarat-ketentuan.edukasi')
    ->name('ruang-edukasi');

Route::view('/about', 'pages.about.index')
    ->name('about');

/*
|--------------------------------------------------------------------------
| CATALOG
|--------------------------------------------------------------------------
*/

Route::prefix('catalog')->group(function () {

    Route::get('/', [CatalogController::class, 'index'])
        ->name('catalog.index');

    Route::get('/{slug}', [CatalogController::class, 'show'])
        ->name('catalog.show');

});

/*
|--------------------------------------------------------------------------
| PROVIDERS
|--------------------------------------------------------------------------
*/

Route::prefix('providers')->group(function () {

    Route::get('/', [ProviderController::class, 'index'])
        ->name('providers.index');

    Route::get('/{slug}', [ProviderController::class, 'show'])
        ->name('providers.show');

});

/*
|--------------------------------------------------------------------------
| CONTACT
|--------------------------------------------------------------------------
*/

Route::prefix('contact')->group(function () {

    Route::get('/', [ContactController::class, 'index'])
        ->name('contact.index');

    Route::post('/', [ContactController::class, 'store'])
        ->name('contact.store');

});

/*
|--------------------------------------------------------------------------
| FORUM
|--------------------------------------------------------------------------
*/

// Route::prefix('forum')->group(function () {

//     Route::get('/', [ForumController::class, 'index'])
//         ->name('forum.index');

//     Route::get('/{slug}', [ForumController::class, 'show'])
//         ->name('forum.show');

// });

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::prefix('dashboard')->group(function () {

        Route::get('/', [UserDashboardController::class, 'index'])
            ->name('dashboard');

        Route::prefix('profile')->group(function () {

            Route::get('/', [DashboardProfileController::class, 'index'])
                ->name('profile.index');

            Route::put('/update', [DashboardProfileController::class, 'update'])
                ->name('profile.update');

        });

    });

    /*
    |--------------------------------------------------------------------------
    | PROVIDER REGISTRATION
    |--------------------------------------------------------------------------
    */

    Route::get('/become-provider', [ProviderController::class, 'create'])
        ->name('provider.create');

    Route::post('/become-provider', [ProviderController::class, 'store'])
        ->name('provider.store');


    /*
    |--------------------------------------------------------------------------
    | FORUM
    |--------------------------------------------------------------------------
    */

    Route::prefix('forum')->group(function () {

        Route::get(
            '/',
            [ForumController::class, 'index']
        )->name('forum.index');

        Route::middleware('auth')->group(function () {

            // THREAD
            Route::get(
                '/create',
                [ForumController::class, 'create']
            )->name('forum.create');

            Route::post(
                '/store',
                [ForumController::class, 'store']
            )->name('forum.store');

            Route::put(
                '/{slug}',
                [ForumController::class, 'update']
            )->name('forum.update');

            Route::delete(
                '/{slug}',
                [ForumController::class, 'destroy']
            )->name('forum.destroy');

            // REPLY
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

        // HARUS PALING BAWAH
        Route::get(
            '/{slug}',
            [ForumController::class, 'show']
        )->name('forum.show');

    });

    /*
    |--------------------------------------------------------------------------
    | CART
    |--------------------------------------------------------------------------
    */

    Route::prefix('cart')->group(function () {

        Route::get('/', [CartController::class, 'index'])
            ->name('cart.index');

        Route::post('/{service}', [CartController::class, 'store'])
            ->name('cart.store');

        Route::delete('/item/{item}', [CartController::class, 'destroy'])
            ->name('cart.destroy');

    });

    /*
    |--------------------------------------------------------------------------
    | SAVED SERVICES
    |--------------------------------------------------------------------------
    */

    Route::prefix('saved')->group(function () {

        Route::get('/', [SavedServiceController::class, 'index'])
            ->name('saved.index');

        Route::post('/{service}', [SavedServiceController::class, 'store'])
            ->name('saved.store');

        Route::delete('/{service}', [SavedServiceController::class, 'destroy'])
            ->name('saved.destroy');

    });

    /*
    |--------------------------------------------------------------------------
    | CHAT
    |--------------------------------------------------------------------------
    */
    Route::prefix('chat')->group(function () {

        Route::get('/', [ConversationController::class, 'index'])
            ->name('chat.index');

        Route::get('/{conversation}', [ConversationController::class, 'show'])
            ->name('chat.show');

        Route::post('/start/{provider}', [ConversationController::class, 'store'])
            ->name('chat.start');

        Route::get('/{conversation}/messages', [MessageController::class, 'index'])
            ->name('chat.messages.index');

        Route::post('/{conversation}/messages', [MessageController::class, 'store'])
            ->name('chat.messages.store');

        Route::post('/{conversation}/read', [MessageController::class, 'markAsRead'])
            ->name('chat.messages.read');

    });

});

/*
|--------------------------------------------------------------------------
| SELLER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'rolemanager:seller'])
    ->prefix('seller')
    ->group(function () {

        Route::get('/dashboard', [SellerDashboardController::class, 'index'])
            ->name('seller.dashboard');

        Route::prefix('services')->group(function () {

            Route::get('/create', [ServiceController::class, 'create'])
                ->name('services.create');

            Route::post('/store', [ServiceController::class, 'store'])
                ->name('services.store');

            Route::get('/{id}/edit', [ServiceController::class, 'edit'])
                ->name('services.edit');

            Route::put('/{id}', [ServiceController::class, 'update'])
                ->name('services.update');

            Route::delete('/{id}', [ServiceController::class, 'destroy'])
                ->name('services.destroy');

        });

    });

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'rolemanager:admin'])
    ->get('/admin/dashboard', function () {
        return view('admin');
    })
    ->name('admin');

require __DIR__ . '/auth.php';

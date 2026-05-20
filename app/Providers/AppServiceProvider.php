<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {

            $cartCount = 0;

            $cartItems = collect();

            if (Auth::check()) {

                $cart = Cart::query()
                    ->with([
                        'items.service.provider',
                    ])
                    ->withCount('items')
                    ->where('user_id', Auth::id())
                    ->first();

                if ($cart) {

                    $cartCount = $cart->items_count;

                    $cartItems = $cart->items;

                }

            }

            $view->with([
                'cartCount' => $cartCount,
                'globalCartItems' => $cartItems,
            ]);

        });
    }
}

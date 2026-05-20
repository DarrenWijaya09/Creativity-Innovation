<?php

namespace App\Http\Controllers\Cart;

use App\Models\Cart;
use App\Models\Service;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Database\Query\Expression;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::query()
            ->with([
                'items.service.provider',
            ])
            ->where('user_id', Auth::id())
            ->first();

        $cartItems = collect();
        $subtotal = 0;

        if ($cart) {
            $cartItems = $cart->items;

            $subtotal = $cartItems->sum(function ($item) {
                return $item->price_snapshot * $item->quantity;
            });
        }

        return view(
            'pages.cart.index',
            compact(
                'cart',
                'cartItems',
                'subtotal'
            )
        );
    }

    public function store(Service $service)
    {
        // ONLY PUBLISHED SERVICE
        if ($service->status !== 'published') {
            abort(404);
        }

        // USER CART
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        // PREVENT DUPLICATE
        $existingItem = CartItem::query()
            ->where('cart_id', $cart->id)
            ->where('service_id', $service->id)
            ->first();

        if ($existingItem) {
            return redirect()
                ->route('cart.index')
                ->with(
                    'info',
                    'Layanan sudah ada di keranjang.'
                );
        }

        // CREATE CART ITEM
        CartItem::create([
            'cart_id' => $cart->id,
            'service_id' => $service->id,
            'quantity' => 1,
            'price_snapshot' => $service->price,
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Layanan berhasil ditambahkan ke keranjang.'
            );
    }

    public function destroy(CartItem $item)
    {
        // AUTHORIZATION
        abort_if(
            $item->cart->user_id !== Auth::id(),
            403
        );

        $item->delete();

        return redirect()
            ->back()
            ->with(
                'success',
                'Layanan berhasil dihapus dari keranjang.'
            );
    }
}

<?php

namespace App\Http\Controllers;

use App\Support\CartSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Good\Entities\Good;
use Modules\Orders\Entities\Order;

class CheckoutController extends Controller
{
    public function show(): Response
    {
        return Inertia::render('Client/CheckoutPage');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'buyer_name' => ['required', 'string', 'max:100'],
            'buyer_phone' => ['required', 'string', 'max:100'],
        ]);

        $cart = CartSession::payload();

        if (empty($cart['items'])) {
            throw ValidationException::withMessages([
                'cart' => 'Your cart is empty.',
            ]);
        }

        $order = DB::transaction(function () use ($validated, $cart) {
            $order = Order::create([
                'buyer_name' => $validated['buyer_name'],
                'buyer_phone' => $validated['buyer_phone'],
                'status' => 'new',
                'total' => $cart['total'],
            ]);

            foreach ($cart['items'] as $item) {
                $order->items()->create([
                    'good_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'bought_price' => $item['price'],
                ]);

                $good = Good::find($item['id']);
                $good?->decrement('quantity', min($item['quantity'], $good->quantity));
            }

            return $order;
        });

        CartSession::clear();

        return redirect()
            ->route('checkout')
            ->with('success', "Order #{$order->id} has been placed.");
    }
}

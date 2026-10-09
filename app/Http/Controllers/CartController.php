<?php

namespace App\Http\Controllers;

use App\Support\CartSession;
use Binafy\LaravelCart\LaravelCart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Good\Entities\Good;

class CartController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(CartSession::payload());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'good_id' => ['required', 'integer', 'exists:goods,id'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $good = Good::findOrFail($validated['good_id']);
        $quantity = $validated['quantity'] ?? 1;

        if (CartSession::findLine($good)) {
            LaravelCart::increaseQuantity($good, $quantity, CartSession::resolveUserId());
        } else {
            LaravelCart::storeItem(['itemable' => $good, 'quantity' => $quantity], CartSession::resolveUserId());
        }

        return response()->json(CartSession::payload());
    }

    public function increase(Good $good): JsonResponse
    {
        LaravelCart::increaseQuantity($good, 1, CartSession::resolveUserId());

        return response()->json(CartSession::payload());
    }

    public function decrease(Good $good): JsonResponse
    {
        $line = CartSession::findLine($good);

        if ($line && (int) $line['quantity'] <= 1) {
            LaravelCart::removeItem($good, CartSession::resolveUserId());
        } else {
            LaravelCart::decreaseQuantity($good, 1, CartSession::resolveUserId());
        }

        return response()->json(CartSession::payload());
    }

    public function destroy(Good $good): JsonResponse
    {
        LaravelCart::removeItem($good, CartSession::resolveUserId());

        return response()->json(CartSession::payload());
    }
}

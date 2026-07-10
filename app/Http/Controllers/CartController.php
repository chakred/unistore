<?php

namespace App\Http\Controllers;

use Binafy\LaravelCart\LaravelCart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Good\Entities\Good;

class CartController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json($this->cartPayload());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'good_id' => ['required', 'integer', 'exists:goods,id'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $good = Good::findOrFail($validated['good_id']);
        $quantity = $validated['quantity'] ?? 1;

        if ($this->findCartLine($good)) {
            LaravelCart::increaseQuantity($good, $quantity, $this->resolveUserId());
        } else {
            LaravelCart::storeItem(['itemable' => $good, 'quantity' => $quantity], $this->resolveUserId());
        }

        return response()->json($this->cartPayload());
    }

    public function increase(Good $good): JsonResponse
    {
        LaravelCart::increaseQuantity($good, 1, $this->resolveUserId());

        return response()->json($this->cartPayload());
    }

    public function decrease(Good $good): JsonResponse
    {
        $line = $this->findCartLine($good);

        if ($line && (int) $line['quantity'] <= 1) {
            LaravelCart::removeItem($good, $this->resolveUserId());
        } else {
            LaravelCart::decreaseQuantity($good, 1, $this->resolveUserId());
        }

        return response()->json($this->cartPayload());
    }

    public function destroy(Good $good): JsonResponse
    {
        LaravelCart::removeItem($good, $this->resolveUserId());

        return response()->json($this->cartPayload());
    }

    private function resolveUserId(): string
    {
        return auth()->id() ? (string) auth()->id() : session()->getId();
    }

    /**
     * The session driver has no public accessor for the raw cart lines,
     * so we read the session under the same key it writes to.
     */
    private function rawCartLines(): array
    {
        return session('cart_'.$this->resolveUserId(), []);
    }

    private function findCartLine(Good $good): ?array
    {
        foreach ($this->rawCartLines() as $line) {
            if ($line['itemable_type'] === Good::class && $line['itemable_id'] === $good->getKey()) {
                return $line;
            }
        }

        return null;
    }

    private function cartPayload(): array
    {
        $items = [];
        $total = 0;

        foreach ($this->rawCartLines() as $line) {
            if ($line['itemable_type'] !== Good::class) {
                continue;
            }

            $good = Good::find($line['itemable_id']);

            if (! $good) {
                continue;
            }

            $quantity = (int) $line['quantity'];
            $subtotal = $quantity * $good->getPrice();

            $items[] = [
                'id' => $good->id,
                'name' => $good->name,
                'image' => $good->img_path,
                'brand' => $good->brand,
                'price' => $good->getPrice(),
                'currency' => $good->currency,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }

        return [
            'items' => $items,
            'total' => $total,
            'count' => array_sum(array_column($items, 'quantity')),
        ];
    }
}

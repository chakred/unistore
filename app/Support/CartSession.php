<?php

namespace App\Support;

use Binafy\LaravelCart\LaravelCart;
use Modules\Good\Entities\Good;

class CartSession
{
    public static function resolveUserId(): string
    {
        return auth()->id() ? (string) auth()->id() : session()->getId();
    }

    /**
     * The session driver has no public accessor for the raw cart lines,
     * so we read the session under the same key it writes to.
     */
    public static function rawLines(): array
    {
        return session('cart_'.self::resolveUserId(), []);
    }

    public static function findLine(Good $good): ?array
    {
        foreach (self::rawLines() as $line) {
            if ($line['itemable_type'] === Good::class && $line['itemable_id'] === $good->getKey()) {
                return $line;
            }
        }

        return null;
    }

    public static function payload(): array
    {
        $items = [];
        $total = 0;

        foreach (self::rawLines() as $line) {
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
                'slug' => $good->slug,
                'name' => $good->name,
                'image' => $good->img_path,
                'brand' => $good->brand,
                'price' => $good->getPrice(),
                'currency' => 'грн',
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

    public static function clear(): void
    {
        foreach (self::rawLines() as $line) {
            if ($line['itemable_type'] !== Good::class) {
                continue;
            }

            $good = Good::find($line['itemable_id']);

            if ($good) {
                LaravelCart::removeItem($good, self::resolveUserId());
            }
        }
    }
}

<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Good\Entities\Good;
use Modules\Orders\Entities\Order;

class UpdateController extends Controller
{
    /**
     * Allowed order statuses.
     *
     * @var string[]
     */
    private array $statuses = ['new', 'canceled', 'invalid', 'handled'];

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:'.implode(',', $this->statuses)],
            'items' => ['required', 'array', 'min:1'],
            'items.*.good_id' => ['required', 'integer', 'exists:goods,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($order, $validated) {
            $order->load('items');
            $originalByGood = $order->items->keyBy('good_id');
            $submittedByGood = collect($validated['items'])->keyBy('good_id');

            foreach ($originalByGood as $goodId => $item) {
                if (! $submittedByGood->has($goodId)) {
                    Good::where('id', $goodId)->increment('quantity', $item->quantity);
                    $item->delete();
                }
            }

            $total = 0;

            foreach ($submittedByGood as $goodId => $submitted) {
                $good = Good::findOrFail($goodId);
                $existing = $originalByGood->get($goodId);
                $newQuantity = (int) $submitted['quantity'];

                if ($existing) {
                    $delta = $newQuantity - $existing->quantity;

                    if ($delta > 0) {
                        $good->decrement('quantity', min($delta, $good->quantity));
                    } elseif ($delta < 0) {
                        $good->increment('quantity', abs($delta));
                    }

                    $existing->update(['quantity' => $newQuantity]);
                    $total += $newQuantity * $existing->bought_price;
                } else {
                    $boughtPrice = $good->getPrice();
                    $good->decrement('quantity', min($newQuantity, $good->quantity));

                    $order->items()->create([
                        'good_id' => $goodId,
                        'quantity' => $newQuantity,
                        'bought_price' => $boughtPrice,
                    ]);

                    $total += $newQuantity * $boughtPrice;
                }
            }

            $order->update([
                'status' => $validated['status'],
                'total' => $total,
            ]);
        });

        return redirect()->back();
    }
}

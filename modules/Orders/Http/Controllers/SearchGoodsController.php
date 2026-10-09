<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Good\Entities\Good;

class SearchGoodsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $keyword = $request->input('q', '');

        $goods = Good::query()
            ->when($keyword !== '', fn ($query) => $query->where('name', 'like', '%'.$keyword.'%'))
            ->orderBy('name')
            ->limit(10)
            ->get();

        return response()->json($goods->map(fn (Good $good) => [
            'id' => $good->id,
            'name' => $good->name,
            'brand' => $good->brand,
            'quantity' => $good->quantity,
            'price' => $good->getPrice(),
        ]));
    }
}

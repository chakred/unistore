<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Category\Entities\Category;
use Modules\Good\Entities\Good;

class GoodPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $good)
    {
        $goodEntity = Good::with(['model.mark', 'mark', 'category'])
            ->where('slug', $good)
            ->where('active', true)
            ->firstOrFail();

        $goodEntity->increment('views');

        $similarGoods = Good::with(['model.mark', 'category'])
            ->where('category_id', $goodEntity->category_id)
            ->where('id', '!=', $goodEntity->id)
            ->where('active', true)
            ->inRandomOrder()
            ->limit(8)
            ->get();

        return Inertia::render('Client/GoodPage', [
            'categories' => Category::withCount('goods')->get(),
            'good' => $goodEntity,
            'similarGoods' => [
                'data' => $similarGoods,
            ],
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Category\Entities\Category;
use Modules\Good\Entities\Good;
use Modules\Mark\Entities\Mark;
use Modules\Mark\Transformers\MarksResource;

class CategoryGoodsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $category)
    {
        $categoryEntity = Category::where('slug', $category)->firstOrFail();

        $priceRange = Good::where('category_id', $categoryEntity->id)
            ->selectRaw('min(cost) as min, max(cost) as max')
            ->first();

        $goodsQuery = Good::with(['model.mark', 'category'])
            ->where('category_id', $categoryEntity->id);

        if ($request->filled('price_min')) {
            $goodsQuery->where('cost', '>=', $request->input('price_min'));
        }

        if ($request->filled('price_max')) {
            $goodsQuery->where('cost', '<=', $request->input('price_max'));
        }

        switch ($request->input('sort')) {
            case 'price_asc':
                $goodsQuery->orderBy('cost', 'asc');
                break;
            case 'price_desc':
                $goodsQuery->orderBy('cost', 'desc');
                break;
            case 'availability':
                $goodsQuery->orderBy('quantity', 'desc');
                break;
        }

        return Inertia::render('Client/GoodsPage', [
            'marks' => new MarksResource(
                Mark::with('models')
                    ->whereHas('models')
                    ->get()
            ),
            'categories' => Category::all(),
            'heading' => $categoryEntity->name,
            'priceRange' => [
                'min' => (float) ($priceRange->min ?? 0),
                'max' => (float) ($priceRange->max ?? 0),
            ],
            'filters' => [
                'price_min' => $request->input('price_min'),
                'price_max' => $request->input('price_max'),
                'sort' => $request->input('sort'),
            ],
            'goods' => $goodsQuery
                ->paginate(12)
                ->appends($request->query()),
        ]);
    }
}

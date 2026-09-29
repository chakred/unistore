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

        $brands = Good::where('category_id', $categoryEntity->id)
            ->whereNotNull('brand')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand');

        $countries = Good::where('category_id', $categoryEntity->id)
            ->whereNotNull('country')
            ->distinct()
            ->orderBy('country')
            ->pluck('country');

        $goodsQuery = Good::with(['model.mark', 'category'])
            ->where('category_id', $categoryEntity->id);

        if ($request->filled('price_min')) {
            $goodsQuery->where('cost', '>=', $request->input('price_min'));
        }

        if ($request->filled('price_max')) {
            $goodsQuery->where('cost', '<=', $request->input('price_max'));
        }

        $brandFilter = array_filter((array) $request->input('brand', []));
        if ($brandFilter) {
            $goodsQuery->whereIn('brand', $brandFilter);
        }

        $countryFilter = array_filter((array) $request->input('country', []));
        if ($countryFilter) {
            $goodsQuery->whereIn('country', $countryFilter);
        }

        if ($request->boolean('in_stock')) {
            $goodsQuery->where('quantity', '>', 0);
        }

        if ($request->boolean('with_discount')) {
            $goodsQuery->where('discount', '>', 0);
        }

        if ($request->filled('original')) {
            $goodsQuery->where('is_original', $request->input('original') === 'original');
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
            case 'discount':
                $goodsQuery->orderBy('discount', 'desc');
                break;
            case 'new':
                $goodsQuery->orderBy('created_at', 'desc');
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
            'brands' => $brands,
            'countries' => $countries,
            'filters' => [
                'price_min' => $request->input('price_min'),
                'price_max' => $request->input('price_max'),
                'brand' => $brandFilter,
                'country' => $countryFilter,
                'in_stock' => $request->boolean('in_stock'),
                'with_discount' => $request->boolean('with_discount'),
                'original' => $request->input('original', ''),
                'sort' => $request->input('sort'),
            ],
            'goods' => $goodsQuery
                ->paginate(12)
                ->appends($request->query()),
        ]);
    }
}

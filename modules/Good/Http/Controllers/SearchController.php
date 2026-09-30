<?php

namespace Modules\Good\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Category\Entities\Category;
use Modules\Good\Actions\SearchGoodAction;
use Modules\Good\Entities\Good;
use Modules\Mark\Entities\Mark;
use Modules\Mark\Transformers\MarksResource;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, SearchGoodAction $action)
    {
        $keyword = $request->input('keyWord', '');

        $goodsQuery = Good::with(['model.mark', 'category'])
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%'.$keyword.'%')
                    ->orWhere('desc', 'like', '%'.$keyword.'%')
                    ->orWhere('brand', 'like', '%'.$keyword.'%');
            });

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

        return Inertia::render('Client/SearchResultPage', [
            'marks' => new MarksResource(
                Mark::with('models')
                    ->whereHas('models')
                    ->get()
            ),
            'models' => Mark::all(),
            'categories' => Category::withCount('goods')->get(),
            'keyword' => $keyword,
            'filters' => [
                'keyWord' => $keyword,
                'sort' => $request->input('sort', ''),
            ],
            'goods' => $goodsQuery
                ->paginate(12)
                ->appends($request->query()),
        ]);
    }
}

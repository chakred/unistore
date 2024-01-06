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
        return Inertia::render('Client/SearchResultPage', [
            'marks' => new MarksResource(
                Mark::with('models')
                    ->whereHas('models')
                    ->get()
            ),
            'models' => Mark::all(),
            'categories' => Category::all(),
            'goods' => Good::with(['model', 'category'])
                ->where('name', 'like', '%'.$request->keyWord.'%')
                ->orWhere('desc','like', '%'.$request->keyWord.'%')
                ->orWhere('brand','like', '%'.$request->keyWord.'%')
                ->paginate(1),
            'viewNumbers' => 0,
        ]);
    }
}

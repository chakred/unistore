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

        return Inertia::render('Client/GoodsPage', [
            'marks' => new MarksResource(
                Mark::with('models')
                    ->whereHas('models')
                    ->get()
            ),
            'categories' => Category::all(),
            'heading' => $categoryEntity->name,
            'goods' => Good::with(['model.mark', 'category'])
                ->where('category_id', $categoryEntity->id)
                ->paginate(12),
        ]);
    }
}

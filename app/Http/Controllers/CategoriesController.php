<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Category\Entities\Category;
use Modules\Good\Entities\Good;
use Modules\Mark\Entities\Mark;
use Modules\Mark\Transformers\MarksResource;
use Modules\Model\Entities\Model as CarModel;

class CategoriesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $mark, string $model)
    {
        $carModel = CarModel::with('mark')
            ->whereHas('mark', fn ($query) => $query->where('slug', $mark))
            ->where('slug', $model)
            ->firstOrFail();

        return Inertia::render('Client/GoodsPage', [
            'marks' => new MarksResource(
                Mark::with('models')
                    ->whereHas('models')
                    ->get()
            ),
            'categories' => Category::all(),
            'heading' => trim($carModel->mark->name.' '.$carModel->name.' '.$request->input('year', '')),
            'goods' => Good::with(['model.mark', 'category'])
                ->where('model_id', $carModel->id)
                ->paginate(12),
        ]);
    }
}

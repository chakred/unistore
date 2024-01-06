<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Category\Entities\Category;
use Modules\Mark\Entities\Mark;
use Inertia\Inertia;
use Modules\Mark\Transformers\MarksResource;

class CategoriesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Client/CategoriesPage', [
            'marks' => new MarksResource(
                Mark::with('models')
                    ->whereHas('models')
                    ->get()
            ),
            'models' => Mark::all(),
            'categories' => Category::all(),
            'viewNumbers' => 0,
        ]);
    }
}

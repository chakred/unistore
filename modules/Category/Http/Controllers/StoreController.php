<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Category\Actions\StoreCategoryAction;
use Modules\Category\Http\Requests\StoreCategoryRequest;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreCategoryRequest $request, StoreCategoryAction $action)
    {
        $action->handle($request);

        return redirect()->route('category.index');
    }
}

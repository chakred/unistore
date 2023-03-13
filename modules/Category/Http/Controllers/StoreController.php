<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Inertia\Inertia;
use Modules\Category\Http\Requests\StoreCategoryRequest;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreCategoryRequest $request)
    {
        $action->handle($request);

        return redirect()->route('category.index');
    }
}

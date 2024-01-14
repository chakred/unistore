<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Inertia\Inertia;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Admin/Category', [
            'categories' => Category::with('parent', 'children')
                ->where('name', 'like', '%'.$request->keyWord.'%')
                ->orWhere('desc','like', '%'.$request->keyWord.'%')
                ->paginate(5),
            'request' => $request->all()
        ]);
    }
}

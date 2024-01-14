<?php

namespace Modules\Good\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Good\Entities\Country;
use Modules\Good\Entities\Good;
use Inertia\Inertia;
use Modules\Mark\Entities\Mark;
use Modules\Model\Entities\Model;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Admin/Good', [
            'goods'      => Good::with('mark', 'model')
                ->where('name', 'like', '%'.$request->keyWord.'%')
                ->orWhere('desc','like', '%'.$request->keyWord.'%')
                ->paginate(5),
            'request' => $request->all(),
            'models'     => Model::with('mark')->get(),
            'marks'      => Mark::pluck('name','id'),
            'countries'  => Country::pluck('name'),
            'categories' => Category::pluck('name','id')
        ]);
    }
}

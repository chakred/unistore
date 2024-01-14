<?php

namespace Modules\Model\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Model\Entities\Model;
use Modules\Mark\Entities\Mark;
use Inertia\Inertia;
use Modules\Model\Transformers\ModelResource;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Admin/Model', [
            'models' => Model::with('mark')
                ->where('name', 'like', '%'.$request->keyWord.'%')
                ->orWhere('transmission','like', '%'.$request->keyWord.'%')
                ->orWhere('engine_type','like', '%'.$request->keyWord.'%')
                ->orwhereHas('mark', function (Builder $query) use ($request) {
                    $query->where('name', 'like', '%'.$request->keyWord.'%');
                })
                ->paginate(5),
            'request' => $request->all(),
            'marks'  => Mark::pluck('name', 'id'),
        ]);
    }
}

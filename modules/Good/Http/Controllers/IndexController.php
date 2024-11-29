<?php

namespace Modules\Good\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
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
            'goods'      => $this->goodsQuery($request)->paginate(5),
            'cost'      => [
                'min' => Good::min('cost'),
                'max' => Good::max('cost')
            ],
            'request'    => $request->all(),
            'models'     => Model::with('mark')->get(),
            'marks'      => Mark::pluck('name','id'),
            'countries'  => Country::pluck('name'),
            'categories' => Category::pluck('name','id')
        ]);
    }

    /**
     * @param Request $request
     * @return Builder
     */
    private function goodsQuery(Request $request): Builder
    {
        $query = Good::with(['model.mark', 'model', 'category']);
        if (!empty($request->keyWord)) {
            $query->where(function ($subQuery) use ($request) {
                $subQuery->where('name', 'like', '%' . $request->keyWord . '%')
                    ->orWhere('desc', 'like', '%' . $request->keyWord . '%');
            });
        }

        if (!empty($request->mark)) {
            $query->orWhereHas('model.mark', function ($subQuery) use ($request) {
                $subQuery->where('name', 'like', '%' . $request->mark . '%');
            });
        }

        return $query;
    }
}

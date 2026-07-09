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
     * Columns that are allowed to be sorted by.
     *
     * @var string[]
     */
    private array $sortable = [
        'id', 'id_inner', 'name', 'desc', 'brand', 'country', 'cost', 'slug', 'active',
    ];

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $sortBy = in_array($request->input('sort_by'), $this->sortable, true)
            ? $request->input('sort_by')
            : 'id';
        $sortDir = $request->input('sort_dir') === 'desc' ? 'desc' : 'asc';

        return Inertia::render('Admin/Good', [
            'goods'      => Good::with('mark', 'model', 'category')
                ->where('name', 'like', '%'.$request->keyWord.'%')
                ->orWhere('desc','like', '%'.$request->keyWord.'%')
                ->orderBy($sortBy, $sortDir)
                ->paginate(5)
                ->appends($request->query()),
            'request' => $request->all(),
            'sort' => [
                'by' => $sortBy,
                'dir' => $sortDir,
            ],
            'models'     => Model::with('mark')->get(),
            'marks'      => Mark::pluck('name','id'),
            'countries'  => Country::pluck('name'),
            'categories' => Category::pluck('name','id')
        ]);
    }
}

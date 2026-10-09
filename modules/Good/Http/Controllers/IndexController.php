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

        $goodsQuery = Good::with('mark', 'model', 'category')
            ->when($request->filled('keyWord'), function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%'.$request->keyWord.'%')
                        ->orWhere('desc', 'like', '%'.$request->keyWord.'%');
                });
            })
            ->when($request->filled('category_id'), fn ($query) => $query->where('category_id', $request->input('category_id')))
            ->when($request->filled('model_id'), fn ($query) => $query->where('model_id', $request->input('model_id')))
            ->when($request->filled('brand'), fn ($query) => $query->where('brand', $request->input('brand')))
            ->when($request->filled('country'), fn ($query) => $query->where('country', $request->input('country')))
            ->when($request->filled('active'), fn ($query) => $query->where('active', $request->input('active')))
            ->orderBy($sortBy, $sortDir);

        return Inertia::render('Admin/Good', [
            'goods'      => $goodsQuery
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
            'categories' => Category::pluck('name','id'),
            'brands'     => Good::whereNotNull('brand')
                ->where('brand', '!=', '')
                ->distinct()
                ->orderBy('brand')
                ->pluck('brand'),
        ]);
    }
}

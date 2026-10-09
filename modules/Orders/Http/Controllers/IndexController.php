<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Orders\Entities\Order;

class IndexController extends Controller
{
    /**
     * Columns that are allowed to be sorted by.
     *
     * @var string[]
     */
    private array $sortable = [
        'id', 'buyer_name', 'buyer_phone', 'status', 'total', 'created_at',
    ];

    /**
     * Allowed order statuses.
     *
     * @var string[]
     */
    private array $statuses = ['new', 'canceled', 'invalid', 'handled'];

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $sortBy = in_array($request->input('sort_by'), $this->sortable, true)
            ? $request->input('sort_by')
            : 'created_at';
        $sortDir = $request->input('sort_dir') === 'asc' ? 'asc' : 'desc';

        $ordersQuery = Order::with('items.good')
            ->when(
                $request->filled('status'),
                fn ($query) => $query->where('status', $request->input('status'))
            )
            ->orderBy($sortBy, $sortDir);

        return Inertia::render('Admin/Order', [
            'orders' => $ordersQuery
                ->paginate(10)
                ->appends($request->query()),
            'request' => $request->all(),
            'sort' => [
                'by' => $sortBy,
                'dir' => $sortDir,
            ],
            'statuses' => $this->statuses,
        ]);
    }
}

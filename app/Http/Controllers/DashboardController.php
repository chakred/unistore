<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Modules\Good\Entities\Good;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\OrderItem;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'totalGoods' => Good::count(),
                'outOfStock' => Good::where('quantity', '<=', 0)->count(),
                'lowStock' => Good::where('quantity', '>', 0)->where('quantity', '<', 3)->count(),
                'totalOrders' => Order::count(),
                'soldGoods' => OrderItem::whereHas(
                    'order',
                    fn ($query) => $query->whereNotIn('status', ['canceled', 'invalid'])
                )->sum('quantity'),
            ],
            'topViewedGoods' => Good::orderByDesc('views')
                ->limit(5)
                ->get(['id', 'name', 'slug', 'views']),
        ]);
    }
}

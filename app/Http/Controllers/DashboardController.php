<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Modules\Good\Entities\Good;

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
            ],
            'topViewedGoods' => Good::orderByDesc('views')
                ->limit(5)
                ->get(['id', 'name', 'slug', 'views']),
        ]);
    }
}

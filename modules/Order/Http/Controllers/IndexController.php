<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Good\Entities\Good;
use Modules\Order\Entities\Order;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Admin/Order', [
            'orders'      => Order::with('goods')
                ->where('status', 'like', '%'.$request->keyWord.'%')
                ->orWhere('comments','like', '%'.$request->keyWord.'%')
                ->paginate(5),
            'request' => $request->all(),
            'goods'   => Good::with('mark', 'model', 'category')->get()
        ]);
    }
}

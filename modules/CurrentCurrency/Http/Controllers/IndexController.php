<?php

namespace Modules\CurrentCurrency\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CurrentCurrency\Entities\CurrentCurrency;
use Inertia\Inertia;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Admin/CurrentCurrency', [
            'currentCurrencies' => CurrentCurrency::orderByDesc('date')->get(),
        ]);
    }
}

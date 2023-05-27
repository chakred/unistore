<?php

namespace Modules\Mark\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Mark\Entities\Mark;
use Inertia\Inertia;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Admin/Mark', [
            'marks' => Mark::all(),
            'viewNumbers' => 0,
        ]);
    }
}

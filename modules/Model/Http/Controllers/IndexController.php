<?php

namespace Modules\Model\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Model\Entities\Model;
use Inertia\Inertia;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Admin/Model', [
            'marks' => Model::all(),
            'viewNumbers' => 0,
        ]);
    }
}

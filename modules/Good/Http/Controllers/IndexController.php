<?php

namespace Modules\Good\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Good\Entities\Good;
use Inertia\Inertia;
use Modules\Model\Entities\Model;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        dd(Model::all());
        return Inertia::render('Admin/Good', [
            'goods' => Good::all(),
            'models' => Model::all(),
        ]);
    }
}

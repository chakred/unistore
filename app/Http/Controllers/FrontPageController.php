<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Mark\Entities\Mark;
use Inertia\Inertia;
use Modules\Mark\Transformers\MarksResource;

class FrontPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Client/FrontPage', [
            'marks' => new MarksResource(Mark::whereHas('models')->get()),
            'models' => Mark::all(),
            'viewNumbers' => 0,
        ]);
    }
}

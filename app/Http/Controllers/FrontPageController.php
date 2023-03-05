<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Mark\Entities\Mark;
use Inertia\Inertia;

class FrontPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Client/FrontPage', [
            'marks' => Mark::all(),
            'models' => Mark::all(),
            'viewNumbers' => 0,
        ]);

      //  return view ('pages.front-page', compact('models','marks', 'viewNumbers'));
    }
}

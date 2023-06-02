<?php

namespace Modules\Mark\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Mark\Actions\StoreMarkAction;
use Modules\Mark\Http\Requests\StoreMarkAutoRequest;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreMarkAutoRequest $request, StoreMarkAction $action)
    {
        $action->handle($request);
        return redirect()->route('mark.index');
    }
}

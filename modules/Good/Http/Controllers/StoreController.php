<?php

namespace Modules\Good\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Good\Actions\StoreGoodAction;
use Modules\Good\Http\Requests\StoreGoodRequest;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreGoodRequest $request, StoreGoodAction $action)
    {
        $action->handle($request);

        return redirect()->route('good.index');
    }
}

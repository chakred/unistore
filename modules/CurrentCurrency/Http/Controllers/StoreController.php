<?php

namespace Modules\CurrentCurrency\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\CurrentCurrency\Actions\StoreCurrentCurrencyAction;
use Modules\CurrentCurrency\Http\Requests\StoreCurrentCurrencyAutoRequest;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreCurrentCurrencyAutoRequest $request, StoreCurrentCurrencyAction $action)
    {
        $action->handle($request);

        return redirect()->route('currentcurrency.index');
    }
}

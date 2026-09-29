<?php

namespace Modules\CurrentCurrency\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\CurrentCurrency\Actions\UpdateCurrentCurrencyAction;
use Modules\CurrentCurrency\Http\Requests\UpdateCurrentCurrencyAutoRequest;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateCurrentCurrencyAutoRequest $request, int $id, UpdateCurrentCurrencyAction $action)
    {
        $action->handle($request, $id);

        return redirect()->route('currentcurrency.index');
    }
}

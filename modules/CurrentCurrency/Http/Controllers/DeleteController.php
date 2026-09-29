<?php

namespace Modules\CurrentCurrency\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CurrentCurrency\Actions\DeleteCurrentCurrencyAction;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id, DeleteCurrentCurrencyAction $action)
    {
        $action->handle($request, $id);

        return redirect()->route('currentcurrency.index');
    }
}

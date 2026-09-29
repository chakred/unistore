<?php

namespace Modules\CurrentCurrency\Actions;

use Illuminate\Http\Request;
use Modules\CurrentCurrency\Entities\CurrentCurrency;

class DeleteCurrentCurrencyAction
{
    /**
     * @param Request $request
     * @param int $id
     * @return bool
     */
    public function handle(Request $request, int $id): bool
    {
        return CurrentCurrency::findOrFail($id)->delete();
    }
}

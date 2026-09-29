<?php

namespace Modules\CurrentCurrency\Actions;

use Modules\CurrentCurrency\Entities\CurrentCurrency;
use Modules\CurrentCurrency\Http\Requests\StoreCurrentCurrencyAutoRequest;

class StoreCurrentCurrencyAction
{
    /**
     * @param StoreCurrentCurrencyAutoRequest $request
     * @return CurrentCurrency
     */
    public function handle(StoreCurrentCurrencyAutoRequest $request): CurrentCurrency
    {
        $isActive = (bool) $request->is_active;

        if ($isActive) {
            CurrentCurrency::where('currency', $request->currency)
                ->update(['is_active' => false]);
        }

        return CurrentCurrency::create([
            'currency'  => $request->currency,
            'rate'      => $request->rate,
            'date'      => $request->date,
            'is_active' => $isActive,
        ]);
    }
}

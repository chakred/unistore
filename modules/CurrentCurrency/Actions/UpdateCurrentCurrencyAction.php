<?php

namespace Modules\CurrentCurrency\Actions;

use Modules\CurrentCurrency\Entities\CurrentCurrency;
use Modules\CurrentCurrency\Http\Requests\UpdateCurrentCurrencyAutoRequest;

class UpdateCurrentCurrencyAction
{
    /**
     * @param UpdateCurrentCurrencyAutoRequest $request
     * @param int $id
     * @return CurrentCurrency
     */
    public function handle(UpdateCurrentCurrencyAutoRequest $request, int $id): CurrentCurrency
    {
        $isActive = (bool) $request->is_active;
        $currentCurrency = CurrentCurrency::findOrFail($id);

        if ($isActive) {
            CurrentCurrency::where('currency', $request->currency)
                ->where('id', '!=', $id)
                ->update(['is_active' => false]);
        }

        $currentCurrency->update([
            'currency'  => $request->currency,
            'rate'      => $request->rate,
            'date'      => $request->date,
            'is_active' => $isActive,
        ]);

        return $currentCurrency;
    }
}

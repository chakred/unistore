<?php

namespace Modules\CurrentCurrency\Entities;

use Illuminate\Database\Eloquent\Model;

class CurrentCurrency extends Model
{
    protected $table = 'current_currency';

    protected $fillable = [
        'currency',
        'rate',
        'date',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'date'      => 'date',
    ];

    /**
     * Per-request memoization so converting many goods doesn't
     * issue a query per row.
     */
    private static array $activeRatesCache = [];

    /**
     * Latest active rate (to UAH) for the given currency, if any.
     */
    public static function activeRate(string $currency): ?float
    {
        $currency = strtoupper($currency);

        if (! array_key_exists($currency, self::$activeRatesCache)) {
            self::$activeRatesCache[$currency] = self::query()
                ->where('currency', $currency)
                ->where('is_active', true)
                ->latest('date')
                ->value('rate');
        }

        $rate = self::$activeRatesCache[$currency];

        return $rate !== null ? (float) $rate : null;
    }
}

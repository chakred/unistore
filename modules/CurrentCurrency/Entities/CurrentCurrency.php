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
}

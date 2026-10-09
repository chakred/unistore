<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Good\Entities\Good;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'good_id',
        'quantity',
        'bought_price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function good()
    {
        return $this->belongsTo(Good::class);
    }
}

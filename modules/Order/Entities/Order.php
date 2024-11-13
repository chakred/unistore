<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Good\Entities\Good;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quantity',
        'bought_price',
        'comments',
        'buyer_name',
        'buyer_email',
        'buyer_phone',
        'currency',
        'status'
    ];

    /**
     * Relation to goods
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goods()
    {
        return $this->hasMany(Good::class, 'id' , 'good_id');
    }
}

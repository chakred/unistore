<?php

namespace Modules\Good\Entities;

use Binafy\LaravelCart\Cartable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Entities\Category;
use Modules\CurrentCurrency\Entities\CurrentCurrency;
use Modules\Model\Entities\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Good extends Model implements Cartable
{
    use HasFactory,
        SoftDeletes;

    protected $appends = [
        'price_uah',
    ];

    protected $fillable = [
        'id_inner',
        'name',
        'desc',
        'img_path',
        'brand',
        'country',
        'cost',
        'profit',
        'discount',
        'is_original',
        'currency',
        'quantity',
        'item',
        'model_id',
        'category_id',
        'active',
        'slug'
    ];

    /**
     * Relation to Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function model()
    {
        return $this->belongsTo(Model::class, 'model_id' , 'id');
    }

    /**
     * Relation to Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id' , 'id');
    }

    /**
     * Price used by the cart, always converted to UAH.
     */
    public function getPrice(): float
    {
        return $this->price_uah;
    }

    /**
     * Cost converted to UAH using the active rate for the good's currency.
     * Falls back to the raw cost if no active rate is found.
     */
    public function getPriceUahAttribute(): float
    {
        $currency = strtoupper($this->currency);

        if ($currency === 'UAH') {
            return round((float) $this->cost, 2);
        }

        $rate = CurrentCurrency::activeRate($currency);

        return round((float) $this->cost * ($rate ?? 1), 2);
    }
}

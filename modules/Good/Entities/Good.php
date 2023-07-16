<?php

namespace Modules\Good\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Model\Entities\Model;

class Good extends Model
{
    use HasFactory;

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
}

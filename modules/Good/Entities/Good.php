<?php

namespace Modules\Good\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Entities\Category;
use Modules\Model\Entities\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Good extends Model
{
    use HasFactory,
        SoftDeletes;

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

    /**
     * Relation to Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id' , 'id');
    }
}

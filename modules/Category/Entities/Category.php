<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Good\Entities\Good;

class Category extends Model
{
    use SoftDeletes;
    /**
     * Fillable.
     */
    protected $fillable = [
        'paremt_id',
        'name',
        'desc',
        'img_path',
        'icon',
        'slug',
        'active'
    ];

    /**
     * Children.
     *
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class , 'parent_id');
    }

    /**
     * Parent.
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class , 'parent_id');
    }

    /**
     * Goods in this category.
     *
     * @return HasMany
     */
    public function goods(): HasMany
    {
        return $this->hasMany(Good::class, 'category_id');
    }
}

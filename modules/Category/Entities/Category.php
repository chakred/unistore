<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /**
     * Fillable.
     */
    protected $fillable = [
        'paremt_id',
        'name',
        'desc',
        'img_path',
        'slug'
    ];

    /**
     * Children.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class , 'parent_id');
    }
}

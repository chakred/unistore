<?php

namespace Modules\Mark\Entities;

use Illuminate\Database\Eloquent\Model as CoreModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Model\Entities\Model;

class Mark extends CoreModel
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'img_path',
        'slug',
        'active'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function models(): HasMany
    {
        return $this->hasMany(Model::class, 'mark_id' , 'id');
    }
}

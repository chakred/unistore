<?php

namespace Modules\Model\Entities;

use Illuminate\Database\Eloquent\Model as CoreModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Mark\Entities\Mark;

class Model extends CoreModel
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'year_start',
        'year_end',
        'engine',
        'engine_type',
        'transmission',
        'transmission_type',
        'img_path',
        'slug'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mark(): BelongsTo
    {
        return $this->belongsTo(Mark::class, 'mark_id' , 'id');
    }
}

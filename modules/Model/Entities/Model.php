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
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function autoMark(): BelongsTo
    {
        return $this->belongsTo(Mark::class, 'mark_id' , 'id');
    }
}

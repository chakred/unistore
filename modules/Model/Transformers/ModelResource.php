<?php

namespace Modules\Model\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ModelResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        dd(parent::toArray($request));
        return parent::toArray($request);
    }
}

<?php

namespace Modules\Model\Actions;

use Illuminate\Http\Request;
use Modules\Model\Entities\Model;

class DeleteModelAction
{
    /**
     * @param Request $request
     * @param int $id
     * @return bool
     */
    public function handle(Request $request, int $id): bool
    {
        return Model::find($id)->delete();
    }
}

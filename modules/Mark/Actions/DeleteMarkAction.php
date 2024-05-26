<?php

namespace Modules\Mark\Actions;

use Illuminate\Http\Request;
use Modules\Mark\Entities\Mark;

class DeleteMarkAction
{
    /**
     * Handle
     *
     * @param Request $request
     * @param int $id
     * @return bool
     */
    public function handle(Request $request, int $id): bool
    {
        return Mark::find($id)->delete();
    }
}

<?php

namespace Modules\Good\Actions;

use Illuminate\Http\Request;
use Modules\Good\Entities\Good;

class DeleteGoodAction
{
    /**
     * Handle
     * @param Request $request
     * @return Good
     */
    public function handle(Request $request, int $id): bool
    {
        return Good::find($id)->delete();
    }
}

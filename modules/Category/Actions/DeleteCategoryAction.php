<?php

namespace Modules\Category\Actions;

use Illuminate\Http\Request;
use Modules\Category\Entities\Category;

class DeleteCategoryAction
{
    /**
     * Handle
     * @param Request $request
     * @return Category
     */
    public function handle(Request $request, int $id): bool
    {
        return Category::find($id)->delete();
    }
}

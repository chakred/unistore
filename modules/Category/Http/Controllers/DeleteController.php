<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Actions\DeleteCategoryAction;

class DeleteController extends Controller
{
    /**
     * @param Request $request
     * @param int $id
     * @param DeleteCategoryAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, int $id, DeleteCategoryAction $action)
    {
        $action->handle($request, $id);
        return redirect()->route('category.index');
    }
}

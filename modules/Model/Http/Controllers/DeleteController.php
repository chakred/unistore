<?php

namespace Modules\Model\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Model\Actions\DeleteModelAction;

class DeleteController extends Controller
{
    /**
     * @param Request $request
     * @param int $id
     * @param DeleteModelAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, int $id, DeleteModelAction $action)
    {
        $action->handle($request, $id);
        return redirect()->route('model.index');
    }
}

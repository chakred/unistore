<?php

namespace Modules\Mark\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Mark\Actions\DeleteMarkAction;
use Modules\Mark\Entities\Mark;
use Inertia\Inertia;

class DeleteController extends Controller
{
    /**
     * @param Request $request
     * @param int $id
     * @param DeleteMarkAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, int $id, DeleteMarkAction $action)
    {
        $action->handle($request, $id);
        return redirect()->route('mark.index');
    }
}

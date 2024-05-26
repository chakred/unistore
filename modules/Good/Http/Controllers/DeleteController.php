<?php

namespace Modules\Good\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Good\Actions\DeleteGoodAction;

class DeleteController extends Controller
{
    /**
     * @param Request $request
     * @param int $id
     * @param DeleteGoodAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, int $id, DeleteGoodAction $action)
    {
        $action->handle($request, $id);
        return redirect()->route('good.index');
    }
}

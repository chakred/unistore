<?php

namespace Modules\Mark\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Mark\Actions\UpdateMarkAction;
use Modules\Mark\Http\Requests\UpdateMarkAutoRequest;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateMarkAutoRequest $request, int $id, UpdateMarkAction $action)
    {
        $action->handle($request, $id);
        return redirect()->route('mark.index');
    }
}

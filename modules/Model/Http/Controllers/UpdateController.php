<?php

namespace Modules\Model\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Model\Actions\UpdateModelAction;
use Modules\Model\Http\Requests\UpdateModelAutoRequest;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateModelAutoRequest $request, int $id, UpdateModelAction $action)
    {
        $action->handle($request, $id);

        return redirect()->route('model.index');
    }
}

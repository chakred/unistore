<?php

namespace Modules\Model\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Model\Actions\StoreModelAction;
use Modules\Model\Entities\Model;
use Inertia\Inertia;
use Modules\Model\Http\Requests\StoreModelAutoRequest;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreModelAutoRequest $request, StoreModelAction $action)
    {
        $action->handle($request);
        return redirect()->route('model.index');
    }
}

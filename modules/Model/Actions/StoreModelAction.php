<?php

namespace Modules\Model\Actions;

use App\ImageHandler\ImageHandler;
use Illuminate\Support\Str;
use Modules\Mark\Entities\Mark;
use Modules\Model\Http\Requests\StoreModelAutoRequest;

class StoreModelAction
{
    /**
     * @param StoreModelAutoRequest $request
     * @return mixed
     */
    public function handle(StoreModelAutoRequest $request)
    {
        $folderDirectoryName = 'models';
        $image = ImageHandler::saveImage($request, $folderDirectoryName);

        $mark = Mark::find($request->mark);

        return $mark->models()->create([
            'name'         => $request->model,
            'engine'       => $request->engine,
            'engine_type'  => $request->engine_type,
            'year_start'   => $request->year_start,
            'year_end'     => $request->year_end,
            'transmission' => $request->transmission,
            'img_path'     => $image,
            'slug'         => Str::slug($request->model, '-')
        ]);
    }
}

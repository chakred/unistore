<?php

namespace Modules\Model\Actions;

use App\ImageHandler\ImageHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Mark\Entities\Mark;

class StoreModelAction
{
    /**
     * Handle
     * @param Request $request
     * @return Mark
     */
    public function handle(Request $request)
    {
        $folderDirectoryName = 'models';
        $image = ImageHandler::saveImage($request, $folderDirectoryName);

        $mark = Mark::find(3);

        return $mark->models()->create([
            'name'         => $request->name,
            'engine'       => $request->engine,
            'engine_type'  => $request->engine_type,
            'year_start'   => $request->year_start,
            'year_end'     => $request->year_end,
            'transmission' => $request->transmission,
            'img_path'     => $image,
            'slug'         => Str::slug($request->name, '-')
        ]);
    }
}

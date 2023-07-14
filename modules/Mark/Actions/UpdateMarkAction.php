<?php

namespace Modules\Mark\Actions;

use App\ImageHandler\ImageHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Mark\Entities\Mark;

class UpdateMarkAction
{
    /**
     * Handle
     *
     * @param Request $request
     * @param int $id
     * @return Mark
     */
    public function handle(Request $request, int $id): Mark
    {
        $folderDirectoryName = 'marks';
        $image = ImageHandler::saveImage($request, $folderDirectoryName);

        $mark = Mark::find($id);
        $mark->update([
            'img_path' => $image,
        ]);

        return $mark;
    }
}

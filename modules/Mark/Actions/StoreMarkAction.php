<?php

namespace Modules\Mark\Actions;

use App\ImageHandler\ImageHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Mark\Entities\Mark;

class StoreMarkAction
{
    /**
     * Handle
     * @param Request $request
     * @return Mark
     */
    public function handle(Request $request): Mark
    {
        $folderDirectoryName = 'marks';
        $image = ImageHandler::saveImage($request, $folderDirectoryName);

        return Mark::create([
            'name'     =>  $request->name,
            'img_path' => $image,
            'slug'     => Str::slug($request->name, '-')
        ]);
    }
}

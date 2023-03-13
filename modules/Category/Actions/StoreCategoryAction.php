<?php

namespace Modules\Category\Actions;

use App\ImageHandler\ImageHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Category\Entities\Category;

class StoreCategoryAction
{
    /**
     * Handle
     * @param Request $request
     * @return Category
     */
    public function handle(Request $request): Category
    {
        $folderDirectoryName = 'categories';
        $image = ImageHandler::saveImage($request, $folderDirectoryName);

        return Category::create([
            'name'     =>  $request->name,
            'img_path' => $image,
            'slug'     => Str::slug($request->name, '-')
        ]);
    }
}

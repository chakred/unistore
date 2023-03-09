<?php

namespace Modules\Mark\Http\Controllers;

use App\ImageHandler\ImageHandler;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Mark\Entities\Mark;
use Inertia\Inertia;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $folderDirectoryName = 'marks';
        $image = ImageHandler::saveImage($request, $folderDirectoryName);


        Mark::create([
            'name' =>  $request->name,
            'img_path' => $image,
            'slug' => Str::slug($request->name, '-')
        ]);
        return back();
    }
}

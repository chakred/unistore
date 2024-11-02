<?php

namespace Modules\Good\Actions;

use App\ImageHandler\ImageHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Good\Entities\Good;

class StoreGoodAction
{
    /**
     * Handle
     * @param Request $request
     * @return Good
     */
    public function handle(Request $request): Good
    {

        $folderDirectoryName = 'goods';
        $image = ImageHandler::saveImage($request, $folderDirectoryName);

        $data = [
            'name'              => $request->name,
            'desc'              => $request->desc,
            'img_path'          => $image,
            'slug'              => Str::slug(implode(' ', [$request->name, $request->desc, $request->brand, $request->category_id]), '-'),
            'brand'             => $request->brand,
            'country'           => $request->country,
            'cost'              => $request->cost,
            'profit'            => $request->profit,
            'discount'          => $request->discount,
            'currency'          => $request->currency,
            'quantity'          => $request->quantity,
            'transmission'      => $request->transmission,
            'transmission_type' => $request->transmission_type,
            'engine_type'       => $request->engine_type,
            'model_id'          => $request->model_id,
            'mark_id'           => $request->mark_id,
            'category_id'       => $request->category_id
        ];

        return Good::create($data);
    }
}

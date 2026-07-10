<?php

namespace Modules\Model\Actions;

use App\ImageHandler\ImageHandler;
use Illuminate\Support\Str;
use Modules\Model\Entities\Model;
use Modules\Model\Http\Requests\UpdateModelAutoRequest;

class UpdateModelAction
{
    /**
     * @param UpdateModelAutoRequest $request
     * @param int $id
     * @return Model
     */
    public function handle(UpdateModelAutoRequest $request, int $id): Model
    {
        $folderDirectoryName = 'models';
        $image = ImageHandler::saveImage($request, $folderDirectoryName);

        $model = Model::findOrFail($id);

        $data = [
            'mark_id'           => $request->mark,
            'name'              => $request->model,
            'engine'            => $request->engine,
            'engine_type'       => $request->engine_type,
            'year_start'        => $request->year_start,
            'year_end'          => $request->year_end,
            'transmission'      => $request->transmission,
            'transmission_type' => $request->transmission_type,
            'active'            => (bool) $request->active,
            'slug'              => Str::slug($request->model, '-'),
        ];

        if ($image) {
            $data['img_path'] = $image;
        }

        $model->update($data);

        return $model;
    }
}

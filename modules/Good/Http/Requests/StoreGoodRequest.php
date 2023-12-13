<?php

namespace Modules\Good\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreGoodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request): array
    {
        dd($request->all());
        return [
            'name'    => 'required|string|min:2|max:100',
            'brand'   => 'required|string|min:2|max:100',
//            'engine' => 'string|min:2|max:100',
//            'engine_type' => 'string|min:2|max:100',
            'desc'    => 'required|string|min:2|max:255',
            'picture' => 'image:jpg,bmp,png',
            'cost'    => 'required|integer',
            'model_id'   => 'required_unless:only_marks,null',
            'mark_id'   => 'required_if:only_marks,null'
        ];
    }
}

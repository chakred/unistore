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
        return [
            'name'    => 'required|string|min:2|max:100',
            'brand'   => 'required|string|min:2|max:100',
            'desc'    => 'required|string|min:2|max:255',
            'picture' => 'image:jpg,bmp,png',
            'cost'    => 'required|integer',
            'quantity' => 'required|integer',
            'model_id' => 'required_unless:only_marks,null',
            'mark_id'  => 'required_if:only_marks,null',
            'currency' => 'required|string|min:2|max:4',
            'country' => 'required|string',
            'category_id' => 'required|integer'
        ];
    }
}

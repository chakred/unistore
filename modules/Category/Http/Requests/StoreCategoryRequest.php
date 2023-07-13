<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreCategoryRequest extends FormRequest
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
            'picture' => 'image:jpg,bmp,png',
        ];
    }
}

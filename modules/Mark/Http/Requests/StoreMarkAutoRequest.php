<?php

namespace Modules\Mark\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarkAutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'required|unique:marks|min:2|max:255',
            'picture' => 'image:jpg,bmp,png'
        ];
    }
}

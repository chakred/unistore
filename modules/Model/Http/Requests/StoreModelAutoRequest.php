<?php

namespace Modules\Model\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreModelAutoRequest extends FormRequest
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
            'mark'              => 'required|max:255',
            'model'             => 'required|string',
            'year_start'        => 'required',
            'year_end'          => 'required',
            'engine'            => 'required',
            'engine_type'       => 'required',
            'transmission'      => 'required',
            'transmission_type' => 'nullable'
        ];
    }
}

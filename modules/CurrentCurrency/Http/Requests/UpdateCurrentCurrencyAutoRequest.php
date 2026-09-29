<?php

namespace Modules\CurrentCurrency\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCurrentCurrencyAutoRequest extends FormRequest
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
            'currency'  => 'required|in:USD,EUR',
            'rate'      => 'required|numeric|min:0',
            'date'      => 'required|date',
            'is_active' => 'nullable|boolean',
        ];
    }
}

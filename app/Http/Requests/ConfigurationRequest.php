<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\FormRequest;

class ConfigurationRequest extends FormRequest
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
            'is_able_to_register' => 'required',
            'register_date' =>  'required|date|after_or_equal:today'
        ];
    }
}

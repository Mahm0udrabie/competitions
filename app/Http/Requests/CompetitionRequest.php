<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\FormRequest;

class CompetitionRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:competitions',
            'start' => 'required|date|after_or_equal:today',
            'end' => 'required|date|after:start',
        ];
    }
}

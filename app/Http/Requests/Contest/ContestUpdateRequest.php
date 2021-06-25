<?php

namespace App\Http\Requests\Contest;

use Illuminate\Foundation\Http\FormRequest;

class ContestUpdateRequest extends FormRequest
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
            'name' => 'required',
            'start' => 'required|date',
            'duration' => 'required|integer',
            'format' => 'required',
            'start' => 'required',
            'duration' => 'required',
            // 'banner' => 'required',
            'description' => 'required',
            'visibility' => 'required',
        ];
    }
}

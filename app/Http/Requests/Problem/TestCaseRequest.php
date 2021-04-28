<?php

namespace App\Http\Requests\Problem;

use Illuminate\Foundation\Http\FormRequest;

class TestCaseRequest extends FormRequest
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
            'point' => 'required|numeric|min:0',
            'input_type' => 'required',
            'input_file' => 'required_if:input_type,upload|file|mimes:text,txt|max:10000',
            'output_type' => 'required',
            'output_file' => 'required_if:output_type,upload|file|mimes:text,txt|max:10000'
        ];
    }
}

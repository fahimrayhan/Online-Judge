<?php

namespace App\Http\Requests\Contest;

use Illuminate\Foundation\Http\FormRequest;

class GenerateContestUserRequest extends FormRequest
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
            'handle_prefix'   => "required|regex:/^[a-zA-Z0-9\_]*$/|min:4|max:30",
            'data_file'       => "required|file",
            'password_length' => "required|integer|min:4|max:16",
        ];
    }
}

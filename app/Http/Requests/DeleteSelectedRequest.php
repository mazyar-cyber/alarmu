<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteSelectedRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'checkBoxArray' => 'array',
        ];
    }

    public function messages()
    {
        return [
            'checkBoxArray.array' => "شما موردی را انتخاب نکرده اید!"
        ];
    }
}

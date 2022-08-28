<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'phoneNumber' => ['required', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:8',],
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'از این ایمیل استفاده شده',
            'phoneNumber.unique' => 'از این شماره تلفن استفاده شده',
        ];
    }
}
